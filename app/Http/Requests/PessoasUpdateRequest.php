<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoasUpdateRequest extends FormRequest
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
            'nome' => 'required|max:255',
            'nascimento_br' => 'required',
            'genero' => 'required|max:255',
            'pais' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nome.required' => 'O nome é obrigatório',
            'nome.max' => 'É permitido no máximo 255 caracteres para o nome',
            'nascimento_br.required' => 'A data de nascimento é obrigatória',
            'genero.required' => 'O gênero é obrigatório',
            'genero.max' => 'É permitido no máximo 255 caracteres para o gênero',
            'pais.required' => 'O país é obrigatório',
        ];
    }
}
