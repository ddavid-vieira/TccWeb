<?php

namespace App\Http\Controllers\ControllerSite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelSite\conferencia;
use App\Models\ModelSite\patrimonio;
use App\Models\ModelSite\servidor;



class ControllerConferencia extends Controller
{
    private $objconferencia;
    private $objpatrimonio;
    private $objservidor;
    public function __construct()
    {
        $this->objconferencia = new conferencia();
        $this->objpatrimonio = new patrimonio();

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
}
