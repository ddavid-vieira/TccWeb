<?php

namespace App\Http\Controllers\ControllerSite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelSite\conferencia;
use App\Models\ModelSite\patrimonio;
use App\Models\ModelSite\servidor;
use App\Models\ModelSite\sala;
use App\Models\ModelApi\RegisterConference;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade as PDF;

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
        $sl = $sala;
        $CodSala = $this->objsala->where("nome", $sala)->get("CodSala");
        $patrimonios = $this->objpatrimonio->where("CodSala", $CodSala[0]["CodSala"])->get();

        return view('GetUniqueConferencia', compact('patrimonios'))->with('sala', $sala);
    }
    public function UniqueReport($Idconferencia, $IdRegisterConference, $Matricula)
    {

        $conferencia = conferencia::where('Idconferencia', $Idconferencia)->get();
        $patrimonios = patrimonio::where('CodSala', $conferencia[0]['CodSala'])->get();
        $patrimoniosVerficados = DB::table('patrimonio')->where('Verificado', '=', '1')->get();
        $patrimoniosAlterados = DB::table('patrimonio')->where('Alterou', '=', '1')->get();
        $CountVerificados = count($patrimoniosVerficados);
        $CountAlterados = count($patrimoniosAlterados);
        $registerConference = RegisterConference::where('IdRegisterConference', $IdRegisterConference)->get();
        $servidor = servidor::where('Matricula', $Matricula)->get();
        return View('Report', compact('servidor', 'registerConference','CountVerificados','CountAlterados','patrimonios','conferencia'));
    }
}
