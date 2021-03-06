<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
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
            'arquivo' => 'required|file'
        ];
    }

    public function messages()
    {

        return [
            'arquivo.required' => 'Insira um arquivo para começar',
            'arquivo.file' => 'Insira um dado do tipo arquivo',
        ];
    }
}
