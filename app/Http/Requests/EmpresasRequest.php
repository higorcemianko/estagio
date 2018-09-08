<?php

namespace estagio\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresasRequest extends FormRequest
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
            'cnpj' => 'required|max:15',
            'razaosocial' => 'required|max:255',
            'cidade' => 'required',
            'usuario' => 'required'
            
        ];
    }

    public function messages(){
        return [
            'required' => 'Informe um(a) :attribute!'
        ];
    }
}
