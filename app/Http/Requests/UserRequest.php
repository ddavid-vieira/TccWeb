<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

            'matricula' => 'required|numeric|',
            'senha' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'matricula.required' => 'Campo Matrícula é obrigatório para acessar o sistema',
            'matricula.numeric' => 'Campo Matrícula só pode haver números',
            'senha.required' => 'Campo Senha  é obrigatório para acessar o sistema',
            'matricula.max' => 'Digite uma Matrícula válida'
        ];
    }
}
