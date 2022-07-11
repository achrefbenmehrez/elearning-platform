<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Http;
use App\Models\Panier;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        $cart = Panier::where('user_id', auth()->user()->id)->get();

        if (count($cart) > 0) {
            session()->put('cart', $cart[0]['donnees_panier']);
        }

        // below is the existing response
        // replace this with your own code
        // the user can be located with Auth facade

        return redirect()->intended(config('fortify.home'));
    }
}
