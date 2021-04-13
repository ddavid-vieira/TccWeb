<?php

namespace App\Http\Controllers\ControllerSite;

use Validator;
use resources\views\vendor\flash;
use App\Http\Requests\UserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelSite\servidor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class ControllerServidor extends Controller
{
    private $objservidor;
    public function __construct()
    {
        $this->objservidor = new servidor();
    }
    public function store(CreateUserRequest $request, servidor $servidor)
    {
        function desformatcpf($cpf)
        {
            $cpf1 = str_replace('.', '', $cpf);
            $cpf2 = str_replace('-', '', $cpf1);
            return $cpf2;
        }
        function desformatTelefone($telefone)
        {
            $telefone1 = str_replace(' ', '', $telefone);
            $telefone2 = str_replace('-', '', $telefone1);
            return  $telefone2;
        }

        $matricula = $request->old('matricula');
        $nome = $request->old('nome');
        $telefone = $request->old('telefone');
        $cpf = $request->old('cpf');
        if ($servidor::insert(
            [
                'Matricula' => $request->matricula,
                'Nome' => $request->nome,
                'Telefone' => desformatTelefone($request->telefone),
                'Cpf' => desformatcpf($request->cpf),
                'Senha' => Hash::make($request->senha)
            ]
        )) {
            return redirect()->route('LoginUser');
        }
    }
    public function auth(UserRequest $request, servidor $servidor)
    {

        $dados = $servidor::whereRaw('Matricula = ?', $request->matricula)->get();
        if (count($dados) == 0) {
            return redirect()->route('LoginUser')->with('message', 'Matrícula e/ou Senha Inválidas');
        }
        if (Hash::check($request->senha, $dados[0]["Senha"])) {
            session_start();
            $_SESSION['Nome'] = $dados[0]['Nome'];
            $_SESSION['Matricula'] = $dados[0]['Matricula'];
            $_SESSION['Telefone'] = $dados[0]['Telefone'];
            $_SESSION['Cpf'] = $dados[0]['Cpf'];
            return redirect()->route('Import');
        } else {
            return redirect()->route('LoginUser')->with('message', 'Matrícula e/ou Senha Inválidas');
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
