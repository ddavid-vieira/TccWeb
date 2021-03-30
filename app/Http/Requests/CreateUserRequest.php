<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'matricula' => 'required|numeric',
            'nome' => 'required',
            'telefone' => 'required',
            'cpf' => 'required',
            'senha' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'matricula.required' => 'Campo Matrícula é obrigatório para o cadastro',
            'matricula.numeric' => 'Campo Matrícula só pode conter números',
            'nome.required' => 'Campo Nome Completo  é obrigatório para o cadastro',
            'telefone.required' => 'Campo Telefone  é obrigatório para o cadastro',
            'cpf.required' => 'Campo CPF é obrigatório para o cadastro',
            'senha.required' => 'Campo Senha  é obrigatório para o cadastro',
        ];
    }
}
