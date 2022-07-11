<?php

namespace App\Actions\Fortify;

use App\models\Role;
use App\Models\User;
use App\Models\Application;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Notifications\RegisteredUser;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Laravel\Fortify\Contracts\CreatesNewUsers;

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
        if (!function_exists('abortToView')) {
            function freeRedirect($path, $msg)
            {
                throw new \Illuminate\Http\Exceptions\HttpResponseException(redirect('/register')->with('Code_CNRPS', $msg));
            }
            function validation($path, $array)
            {
                throw new \Illuminate\Http\Exceptions\HttpResponseException(redirect()
                    ->back()
                    ->withErrors($array)
                    ->withInput());
            }
        }

        $validator = Validator::make($input, [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'required|string|confirmed|min:8',
        ], [
            'digits_between' => 'Le code CNRPS doit etre composé de 8 chiffres'
        ]);
        if ($validator->fails()) {
            validation('/register', $validator);
        }

        if (count(User::where('nom_utilisateur', $input['nom'] . $input['prenom'])->get()) > 0) {
            freeRedirect('/register', 'Account already exists');
        }

        Auth::login($user = User::create([
            "nom_utilisateur" => $input['nom'] . $input['prenom'],
            'email' => $input['email'],
            'password' => Hash::make($input['password'])
        ]));

        $user->assignRole("client");

        $admins = User::whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->get();
        Notification::send($admins, new RegisteredUser($user));

        return $user;
    }
}
