<?php

namespace App\Http\Controllers\ControllerSite;

//require __DIR__ . "/vendor/autoload.php";

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelSite\patrimonio;
use App\Models\ModelSite\sala;


class ControllerPatrimonio extends Controller
{

    private $objpatrimonio;
    private $objsala;
    public function __construct()
    {
        $this->objpatrimonio = new patrimonio();
        $this->objsala = new sala();
    }
    public function index()
    {
        dd($this->objsala->find(3)->relPatrimonio);
    }
    public function store(Request $request, patrimonio $patrimonio)
    {
        if ($request->hasFile('arquivo')) {
            $extension = $request->file('arquivo')->getClientOriginalExtension();
            if ($extension != 'csv') {
                return 'Apenas csv';
            } else {
                $obj = fopen($request->file('arquivo'), 'r');
                while (($dados = fgetcsv($obj, 1000, ';')) !== FALSE) {
                    if ($dados[0] != 'Unidade Gestora') {
                        $dado = sala::where("nome", $request->sala)->get("CodSala");
                        patrimonio::insert(
                            [
                                'CodPatrimonio' => "$dados[2]",
                                'CodSala' => $dado[0]['CodSala'],
                                'DataTombamento' => "$dados[3]",
                                'DataGarantia' => "$dados[4]",
                                'Denominacao' => "$dados[6]",
                                'Marca' => "$dados[9]",
                                'Estado' => "$dados[10]",
                                'Finalidade' => "$dados[12]",
                                'Depreciavel' => "$dados[14]",
                                'Valor' => "$dados[19]",


                            ]
                        );
                    }
                }
            }
        } else {
            return 'Envie um arquivo valido';
        }
    }
    public function deletePatrimonios(patrimonio $patrimonio, $id)
    {
        $query = $patrimonio::where('CodSala', $id);
        if ($query->delete()) {
            return 'Deletado';
        } else {
            return 'não deletado';
        }
    }
}
