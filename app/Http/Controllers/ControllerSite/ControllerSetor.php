<?php

namespace App\Http\Controllers\ControllerSite;

use App\Models\ModelSite\setor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ControllerSetor extends Controller
{
    private $objsetor;

    public function __construct()
    {
        $this->objsetor = new setor();
    }
    public function create(Request $request, setor $setor)
    {
        if (setor::insert([
            'nome' => $request->nome


        ])) {
            return redirect('allSetor');
        }
    }
    public function all(){
        $AllSetores =$this->objsetor->all();
        return view('CreateSetor',compact('AllSetores'));
    }
}
