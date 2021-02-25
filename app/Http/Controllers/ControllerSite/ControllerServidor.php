<?php

namespace App\Http\Controllers\ControllerSite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelSite\servidor;

class ControllerServidor extends Controller
{
    private $objservidor;
    public function __construct()
    {
        $this->objservidor = new servidor();
    }
    public function store(Request $request, servidor $servidor)
    {
        if (servidor::insert(
            [
                'Matricula' => $request->matricula,
                'Nome' => $request->nome,
                'Telefone' => $request->telefone,
                'Cpf' => $request->cpf,
                'Senha' => md5($request->senha)
            ]
        )) {
            return redirect()->route('LoginUser');
        }
    }
    public function auth(Request $request, servidor $servidor)
    {
        if ($dados = $servidor::whereRaw('Matricula = ? and Senha = ? ', [$request->matricula, md5($request->senha)])->get()) {
            session(['UserData' => $dados]);
            return view('Import', ['dados' => $dados]);
        } else {
            return 'Usuário não encontrado';
        }
    }
    public function logout()
    {
        session()->forget('UserData');
        return view('LoginUser');
    }
}
