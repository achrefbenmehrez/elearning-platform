<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ];

        $admins = User::whereHas('roles', function($q){
            $q->where('name', 'admin');
            })->get();

        foreach($admins as $admin)
        {
            Mail::to($admin)->send(new ContactMail($details));
        }

        return back()->with('status', 'Votre message a ete envoyé avec succes');
    }
}
