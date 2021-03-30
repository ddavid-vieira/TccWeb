<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UniqueQrCodeRequest extends FormRequest
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
            'qrcodes' => 'required'
        ];
    }
    public function messages()
    {

        return [
            'qrcodes.required' => 'Insira algum  dado para começar',
        ];
    }
}
