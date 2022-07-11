<?php

namespace App\Http\Controllers\Back;

use App\Models\Carte;
use App\Http\Controllers\Controller;

class CarteController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartes = Carte::paginate(10);

        return view('back.cartes.index', compact('cartes'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carte = Carte::findOrFail($id);

        return view('back.cartes.show',compact('carte')) ;
    }
}
