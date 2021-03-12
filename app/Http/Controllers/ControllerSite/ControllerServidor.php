<?php

namespace App\Http\Controllers\ControllerSite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelSite\servidor;
use Illuminate\Support\Facades\Auth;
use Session;

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


            session_start();
            $_SESSION['Nome'] = $dados[0]['Nome'];
            $_SESSION['Matricula'] = $dados[0]['Matricula'];
            $_SESSION['Telefone'] = $dados[0]['Telefone'];
            $_SESSION['Cpf'] = $dados[0]['Cpf'];
            return redirect()->route('Import');
        } else {
            return 'Usuário não encontrado';
        }
    }
    public function logout()
    {
        session_start();
        session_destroy();
        return view('LoginUser');
    }
    public function deleteServidor(servidor $servidor, $id)
    {
        $query = $servidor::where('Matricula', $id);
        if ($query->delete()) {
            return 'Deletado';
        } else {
            return 'não deletado';
        }
    }
}
