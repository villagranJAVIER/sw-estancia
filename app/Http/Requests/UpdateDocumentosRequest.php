<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentosRequest extends FormRequest
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
            'URL_documento' => ['required','mimes:pdf,docx,doc'],
        ];
    }
    public function attributes(): array
    {
        return [
            'URL_documento' => 'Archivo',
        ];
    }
}
