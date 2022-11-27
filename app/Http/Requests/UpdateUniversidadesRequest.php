<?php

namespace App\Http\Requests;

use App\Models\Universidades;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUniversidadesRequest extends FormRequest
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
            'nombre' => ['required','max:255',Rule::unique('Universidades')->ignore($this->id)],
            'direccion' => 'required|max:255',
            'telefono' => 'numeric|required',
        ];
    }
    public function attributes(): array
    {
        return [
            'nombre' => 'nombre',
            'direccion' => 'dirección',
            'telefono' => 'telefono',
        ];
    }
}
