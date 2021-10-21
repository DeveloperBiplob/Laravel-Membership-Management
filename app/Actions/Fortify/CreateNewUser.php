<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            // $user->userName = $request->userName ;
            // $user->phone = $request->phone ;
            // $user->status = $request->status ;
            // $user->designation_id = $request->designation_id ;

            'name' => $input['name'],
            'userName' => Str::slug($input['name']) . time(),
            'designation_id' => 1,
            'phone' => $input['phone'],
            'status' => 'Inactive',
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
