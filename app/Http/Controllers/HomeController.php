<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Discussion;
use App\Models\Formation;
use App\Models\TypeAbonnement;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index()
    {
        $nouveautes = Formation::latest()->with(['user', 'categories'])->paginate(8);
        $plus_visites = Formation::orderBy('view_count', 'desc')->with(['user', 'categories'])->paginate(8);
        $discussions = Discussion::take(3)->with(['author', 'replies', 'channel'])->get();
        $type_abonnements = TypeAbonnement::all();

        $categories = Categorie::take(8)->get();

        return view('welcome', [
            'nouveautes' => $nouveautes,
            'plus_visites' => $plus_visites,
            'categories' => $categories,
            'discussions' => $discussions,
            'type_abonnements' => $type_abonnements
        ]);
    }

    public function propos()
    {
        return view('propos');
    }
}
