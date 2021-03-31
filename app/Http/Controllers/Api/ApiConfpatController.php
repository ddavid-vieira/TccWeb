<?php

namespace App\Http\Controllers\Api;

use App\Models\ModelApi\RegisterConference;
use App\Http\Requests\CreateConferenceRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelApi\ApiConfpatModel;
use App\Models\ModelSite\conferencia;
use App\Models\ModelSite\sala;
use App\Models\ModelSite\servidor;
use App\Models\ModelSite\patrimonio;
use App\Models\ModelSite\setor;


use Exception;
use Illuminate\Support\Facades\Hash;

class ApiConfpatController extends Controller
{
    public function __construct()
    {
        $this->objsala = new sala();
        $this->objsetor = new setor();
        $this->objservidor = new servidor();
    }
    public function list()
    {
        try {
            $dados = (array) ApiConfpatModel::all();
            return ["status" => 200, "data" => $dados["\x00*\x00items"]];
        } catch (Exception $e) {
            return ["retorno" => $e->getMessage()];
        }
    }
    public function select($id)
    {
        try {
            $dados = ApiConfpatModel::where("CodPatrimonio", $id)->get();
            return $dados;
        } catch (Exception $e) {
            return ["retorno" => $e->getMessage()];
        }
    }
    public function store(CreateConferenceRequest $request, conferencia $conferencia)
    {
       
        $CodSala = $this->objsala::where("nome", $request->SelectSala)->get("CodSala");
        $CodSetor = $this->objsetor::where("nome", $request->SelectSetor)->get("CodSetor");
        if ($CodSala != null && $CodSetor != null) {
            if ($conferencia::insert(
                [
                    'CodSala' => $CodSala[0]["CodSala"],
                    'Sala' =>  $request->SelectSala,
                    'CodSetor' => $CodSetor[0]["CodSetor"],
                    'NomeSetor' => $request->SelectSetor,
                    'Data' => $request->data

                ]
            )) {
                return redirect()->route('CreateConference');
            }
        }
    }
    public function listdata(Request $request)
    {
        $AllSalas = $this->objsala->all();
        $AllSetores = $this->objsetor->all();
        return view('CreateConference', compact('AllSalas', 'AllSetores'));
    }
    public function listConference()
    {
        try {
            $dados = conferencia::all();

            return ["status" => 200, "data" => $dados];
        } catch (Exception $e) {
            return ["retorno" => $e->getMessage()];
        }
    }
    public function UniqueConference($id)
    {
        if ($dados = conferencia::where('Idconferencia', $id)->get()) {
            $CodSala = $dados[0]["CodSala"];
            $patrimonios = patrimonio::where("CodSala", $CodSala)->get();
            $countPatrimonios = patrimonio::where('Verificado', false)->get();
            return [
                "status" => 200,
                "data" => $dados,
                "Quantidade" => count($countPatrimonios),
                "Patrimonios" => $patrimonios
            ];
        } else {
            return ["status" => 404];
        }
    }
    public function CreateUserApi(Request $request)
    {

        servidor::insert(
            [
                'Matricula' => $request->matricula,
                'Nome' => $request->nome,
                'Telefone' => $request->telefone,
                'Cpf' => $request->cpf,
                'Senha' => Hash::make($request->senha)
            ]
        );
        return 'true';
    }
    public function auth(Request $request, servidor $servidor)
    {
        $dados = $servidor::whereRaw(' "Matricula" = ?', $request->matricula)->get();
        if (Hash::check($request->senha, $dados[0]["Senha"]) && sizeof($dados) != 0) {
            return [
                'authenticated' => true,
                'data' => $dados,
                'message' => 'ok'
            ];
        } else {
            return ['message' => 'Login Failed'];
        }
    }
    public function listConferencebySetor($id)
    {
        try {

            $dados = conferencia::where("CodSetor", $id)->get();

            return ["status" => 200, "data" => $dados];
        } catch (Exception $e) {
            return ["retorno" => $e->getMessage()];
        }
    }
    public function allSetores()
    {
        $dados = $this->objsetor::all();

        if ($dados != null) {
            return ["data" => $dados];
        }
    }
    public function updatePatrimonio(Request $request, patrimonio $patrimonio, $CodPatrimonio)
    {
        try {
            $data = $patrimonio::find($CodPatrimonio);

            if ($request->Estado != $data->Estado) {
                $data->Alterou = true;
                $data->Estado = $request->Estado;
                $data->Verificado = true;
            } else {
                $data->Alterou = false;
                $data->Verificado = true;
            }
            $data->save();
            return [
                "message" => "ok",
                "Patrimonio" => $data
            ];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
    public function registerconference(Request $request, RegisterConference $registerConference)
    {
        if ($registerConference::insert(
            [
                'Idconferencia' => $request->Idconferencia,
                'Matricula' => $request->Matricula,
                'DataInit' =>  $request->DataInit,
                'DataClose' => $request->DataClose,
                'Estado' => $request->Estado,
            ]
        )) {
            return ['Insert' => true];
        } else {
            return ['Insert' => false];
        }
    }
}
