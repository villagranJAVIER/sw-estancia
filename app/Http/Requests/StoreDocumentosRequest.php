<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDocumentosRequest extends FormRequest
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
            'nombre_documento' => ['required','max:255'],
            'URL_documento' => ['required','mimes:pdf'],
        ];
    }
    public function attributes(): array
    {
        return [
            'nombre_documento' => 'Documento',
            'URL_documento' => 'Archivo',
        ];
    }
}
