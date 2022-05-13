<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Senior;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewSenior implements CreatesNewUsers
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
            'login' => ['required', 'string', 'login', 'max:255', 'unique:seniors'],
            'address' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return Senior::create([
            'login' => $input['login'],
            'address' => $input['address'],
            'password' => Hash::make($input['password']),

        ]);
    }
}
