<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateusuarioRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'apellidoP' => ['required', 'string', 'max:255'],
            'apellidoM' => ['required', 'string', 'max:255'],
            'id_universidad' => ['max:255'],
            'tipo' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->id)],
        ];
    }
    public function attributes(): array
    {
        return [
            'name' => 'Nombre',
            'apellidoP' => 'Apellido paterno',
            'apellidoM' => 'Apellido materno',
            'id_universidad' => 'Universidad',
            'tipo' => 'Tipo usuario',
            'email' => 'Correo electrónico',
        ];
    }
}
