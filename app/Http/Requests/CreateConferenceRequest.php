<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateConferenceRequest extends FormRequest
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
            'SelectSetor' => 'required',
            'SelectSala' => 'required',
            'data' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'SelectSetor.required' => "Selecione um setor para começar",
            'SelectSala.required' => 'Selecione um sala para começar',
            'data.required' => 'Selecione uma data para começar'

        ];
    }
}
