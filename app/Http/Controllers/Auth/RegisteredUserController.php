<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\RegisteredUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Notification;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        if (!function_exists('abortToView')) {
            function freeRedirect($path, $msg)
            {
                throw new \Illuminate\Http\Exceptions\HttpResponseException(redirect('/register')->with('Code_CNRPS', $msg));
            }
        }

        if (isset($request->Code_CNRPS)) {
            $request->role_id = 3;
        } else {
            $request->role_id = 2;
        }

        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'required|string|confirmed|min:8',
            'role_id' => 'exists:roles,id,id,!1,id,!5,id,!6,id,!4'
        ], [
            'digits_between' => 'Le code CNRPS doit etre composé de 8 chiffres'
        ]);

        if (count(User::where('nom_utilisateur', $request->nom . $request->prenom)->get()) > 0) {
            freeRedirect('/register', 'Account already exists');
        }

        Auth::login($user = User::create([
            "nom_utilisateur" => $request->nom . $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]));

        $admins = User::whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->get();
        Notification::send($admins, new RegisteredUser($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
