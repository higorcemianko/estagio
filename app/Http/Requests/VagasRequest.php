<?php

namespace estagio\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VagasRequest extends FormRequest
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
            'titulo' => 'required|max:255',
            'descricao' => 'required|max:255',
            'inicio' => 'required',
            'fim' => 'required',
            'salario' => 'required'
            
        ];
    }

    public function messages(){
        return [
            'required' => 'O campo :attribute deve ser preenchido!'
        ];
    }
}
