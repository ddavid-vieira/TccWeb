<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelApi\ApiConfpatModel;
use App\Models\ModelSite\conferencia;
use App\Models\ModelSite\sala;
use App\Models\ModelSite\servidor;
use App\Models\ModelSite\patrimonio;
use Exception;

class ApiConfpatController extends Controller
{
    public function __construct()
    {
        $this->objsala = new sala();
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
        if ($CodSala = $this->objsala::where("nome", $request->SelectSala)->get("CodSala") &&
            $Matricula = $this->objservidor::where("Nome", $request->SelectServidor)->get("Matricula",)
        ) {
            if ($conferencia::insert(
                [
                    'CodSala' => $CodSala,
                    'Sala' =>  $request->SelectSala,
                    'Matricula' => $Matricula[0]["Matricula"],
                    "Servidor" => $request->SelectServidor,
                    'Data' => $request->data

                ]
            )) {
                return redirect('api/getConferences');
            }
        }
    }
    public function listdata()
    {
        $AllSalas = $this->objsala->all();
        $AllServidores = $this->objservidor->all();
        return View('CreateConference', compact('AllSalas', 'AllServidores'), compact('AllServidores'));
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
}
