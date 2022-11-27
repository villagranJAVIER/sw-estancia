<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEspaciosRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre_documento' => ['required','max:255',Rule::unique('Espacios')->ignore($this->id)],
            'nombre_plantilla' => 'max:255',
            'URL_plantilla' => 'max:255'
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre_documento' => 'Nombre del documento',
            'nombre_plantilla' => 'Nombre de la plantilla',
            'URL_plantilla' => 'URL de la plantilla'
        ];
    }   
}
