<?php

namespace App\Http\Controllers\ControllerSite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelSite\conferencia;
use App\Models\ModelSite\patrimonio;
use App\Models\ModelSite\servidor;
use App\Models\ModelSite\sala;



class ControllerConferencia extends Controller
{
    private $objconferencia;
    private $objpatrimonio;
    private $objservidor;

    public function __construct()
    {
        $this->objconferencia = new conferencia();
        $this->objpatrimonio = new patrimonio();
        $this->objsala = new sala();

        $this->objservidor = new  servidor();
    }
    public function deleteConferencias($id)
    {
        $query = $this->objconferencia::find($id);
        if ($query->delete()) {
            return 'Deletado';
        } else {
            return 'não deletado';
        }
    }
    public function listconferences()
    {
        $conferencias = $this->objconferencia->all();
        $datas = $this->objconferencia->get("Data");
        return view('ListConferences', compact('conferencias'));
    }
    public function getUniqueConferencia($sala)
    {
        $sl =$sala;
        $CodSala = $this->objsala->where("nome", $sala)->get("CodSala");
        $patrimonios = $this->objpatrimonio->where("CodSala", $CodSala[0]["CodSala"])->get();

        return view('GetUniqueConferencia', compact('patrimonios'))->with('sala', $sala);
    }
}
