<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Models\TypeAbonnement;
use App\Http\Controllers\Controller;

class TypeAbonnementController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_abonnements = TypeAbonnement::paginate(10);

        return view('back.type_abonnements.index', compact('type_abonnements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('back.type_abonnements.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $this->validate($request,
    //     [
    //         'user_id' => ['required', 'string', 'exists:users,id'],
    //         'type_abonnement_id' => ['required', 'string', 'exists:type_abonnements,id'],
    //         'active' => 'required|boolean',
    //         'carte_id' => ['required', 'string', 'exists:cartes,id'],
    //         'montant' => 'required|between:0,99.99',
    //         'date_de_fin' => 'required|date'
    //     ]);

    //     Abonnement::create(
    //         [
    //             'user_id' => $request->user_id,
    //             'type_abonnement_id' => $request->type_abonnement_id,
    //             'active' => $request->active,
    //             'carte_id' => $request->carte_id,
    //             'montant_paye' => $request->montant,
    //             'date_de_fin' => $request->date_de_fin
    //         ]
    //     );

    //    return redirect()->route('admin.abonnements.index')->with('status', 'Abonnement cree');
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type_abonnement = TypeAbonnement::findOrFail($id);

        return view('back.type_abonnements.show',compact('type_abonnement')) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $abonnement = Abonnement::findOrfail($id);
    //     return view('back.abonnements.edit',compact('abonnement'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     $abonnement = Abonnement::findOrFail($id);

    //     $this->validate($request,
    //     [
    //         'user_id' => ['required', 'string', 'exists:users,id'],
    //         'type_abonnement_id' => ['required', 'string', 'exists:type_abonnements,id'],
    //         'active' => 'required|boolean',
    //         'carte_id' => ['required', 'string', 'exists:cartes,id'],
    //         'montant' => 'required|between:0,99.99',
    //         'date_de_fin' => 'required|date'
    //     ]);

    //     $abonnement->update(
    //         [
    //             'user_id' => $request->user_id,
    //             'type_abonnement_id' => $request->type_abonnement_id,
    //             'active' => $request->active,
    //             'carte_id' => $request->carte_id,
    //             'montant_paye' => $request->montant,
    //             'date_de_fin' => $request->date_de_fin
    //         ]
    //     );

    //    return redirect()->route('admin.abonnements.index')->with('status', 'Abonnement modifié');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Abonnement $abonnement)
    // {
    //     $abonnement->delete();
    //     return back()->with('status', 'Abonnement supprimé');
    // }
}
