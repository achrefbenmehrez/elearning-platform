<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends \App\Http\Controllers\Controller
{
    public function change_photo(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'max:1024'],
        ]);

        $user = auth()->user();

        $photo_url = $request->file('photo')->storeAs('ProfilePictures', $request->file('photo')->getClientOriginalName());
        $user->photo_url = $photo_url;
        $user->save();

        return redirect()->back()->with('status', 'Photo de profile modifiée');
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:3', 'max:255'],
            'password_confirmation' => ['required', 'string', 'min:3', 'max:255', 'same:password'],
        ]);

        $user = auth()->user();
        if(Hash::check($request->current_password, $user->password))
        {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->with('status', 'Mot de passe modifié');
        }
        else
        {
            return redirect()->back()->with('status', 'Le mot de passe actuel saisis est invalide');
        }
    }

    public function change_infos(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'nom_utilisateur' => ['required', 'string', 'max:255', 'unique:users,nom_utilisateur'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id]
        ]);

        $user->nom_utilisateur = $request->nom_utilisateur;
        $user->email = $request->email;

        $user->save();

        return redirect()->back()->with('status', 'Details personnels modifiés');
    }
}
