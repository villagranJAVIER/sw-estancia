<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'apellidoP' => ['required', 'string', 'max:255'],
            'apellidoM' => ['required', 'string', 'max:255'],
            'id_universidad' => ['max:255'],
            'tipo' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'apellidoP' => $input['apellidoP'],
            'apellidoM' => $input['apellidoM'],
            'id_universidad' => $input['id_universidad'],
            'tipo' => $input['tipo'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
