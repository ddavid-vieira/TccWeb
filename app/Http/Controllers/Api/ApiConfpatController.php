<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelApi\ApiConfpatModel;
use App\Models\ModelSite\conferencia;
use App\Models\ModelSite\sala;
use App\Models\ModelSite\servidor;
use App\Models\ModelSite\patrimonio;
use App\Models\ModelSite\setor;

use Exception;

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
    public function store(Request $request, conferencia $conferencia)
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
                return redirect()->view('CreateConference');
            }
        }
    }
    public function listdata(Request $request)
    {
        $AllSalas = $this->objsala->all();
        $AllSetores = $this->objsetor->all();

        return view('CreateConference', compact('AllSalas', 'AllSetores'))->with('UserData', session('UseData'));
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
            return [
                "status" => 200,
                "data" => $dados,
                "Quantidade" => count($patrimonios),
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
                'Senha' => md5($request->senha)
            ]
        );
        return 'true';
    }
    public function auth(Request $request, servidor $servidor)
    {
        $dados = $servidor::whereRaw(' "Matricula" = ? and "Senha" = ? ', [$request->matricula, md5($request->senha)])->get();
        if (sizeof($dados) != 0) {
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
    public function getSalas()
    {
        return 'a';
    }
}
