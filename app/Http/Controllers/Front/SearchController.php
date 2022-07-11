<?php

namespace App\Http\Controllers\Front;

use App\Models\Categorie;

use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends \App\Http\Controllers\Controller
{
    public function search(Request $request)
    {
        $q = $request->input('q');
        $formations = Formation::where('nom', 'LIKE', '%' . $q . '%')->orWhere('description', 'LIKE', '%' . $q . '%')->paginate(7);
        $nouveautes = Formation::latest()->paginate(6);

        $categories = Categorie::paginate(5);

        return view('front.formations.search', [
            'formations' => $formations,
            'nouveautes' => $nouveautes,
            'categories' => $categories,
            'query' => $q
        ]);
    }

    public function autocomplete(Request $request)
    {
        $term = $request->query('term');

        $queries = Formation::select('nom as value', 'application_id')
            ->where('nom', 'LIKE', '%' . $term . '%')
            ->take(5)->get();

        $queries = $queries->pluck('value');


        return response()->json($queries);
    }
}
