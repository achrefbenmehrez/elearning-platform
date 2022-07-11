<?php

namespace App\Http\Controllers\Front;

use App\Models\Categorie;

class FormationCategorieController extends \App\Http\Controllers\Controller
{
    public function index(Categorie $categorie)
    {
        $formations = $categorie->formations()->with('categories')->paginate(12);
        $categories = $categorie::paginate(8);

        return view('front.formations.categories', [
            'formations' => $formations,
            'categorie' => $categorie,
            'categories' => $categories
        ]);
    }
}
