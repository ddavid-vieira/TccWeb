<?php

namespace App\Http\Controllers\ControllerSite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelSite\setor;
use App\Models\ModelSite\sala;


class ControllerSala extends Controller
{
    private $objsala;
    private $objsetor;

    public function __construct()
    {
        $this->objsala = new sala();
        $this->objsetor = new setor();
    }

    public  function getSalas(Request $request)
    {
        if ($CodSetor = setor::where("nome", $request->SelectSetor)->get("CodSetor")) {
            if ($salas = sala::where("CodSetor", $CodSetor[0]["CodSetor"])->get("nome")) {
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function create(Request $request)
    {
        if ($CodSetor = setor::where("nome", $request->SelectSetor)->get("CodSetor")) {
            if (sala::insert([
                'CodSetor' => $CodSetor[0]["CodSetor"],
                'nome' => $request->sala
            ])) {
                return redirect('allSetor');
            }
        }
    }

    public function list(Request $request)
    {
        $AllSetores = $this->objsetor->all();
        $salas = $this->objsala->all();
        return view('ListSalas', compact('AllSetores','salas'));
    }
    public function deleteSala($id, sala $sala){
        $query = $sala::where('CodSala', $id);
        if ($query->delete()) {
            return 'Deletado';
        } else {
            return 'não deletado';
        }
    }
   

}
