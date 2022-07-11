<?php

namespace App\Http\Controllers\Back;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payement;

class PayementController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payements = Payement::paginate(10);

        return view('back.payements.index', compact('payements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.payements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
           'user_id' => ['required', 'string', 'exists:users,id'],
           'formation_id' => ['required', 'string', 'exists:formations,id'],
           'carte_id' => ['required', 'string', 'exists:cartes,id'],
           'montant' => 'required|between:0,99.99'
        ]);

        Payement::create(
            [
                'user_id' => $request->user_id,
                'formation_id' => $request->formation_id,
                'carte_id' => $request->carte_id,
                'montant_paye' => $request->montant
            ]
        );

       return redirect()->route('admin.payements.index')->with('status', 'Payement cree');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payement = Payement::findOrFail($id);

        return view('back.payements.show',compact('payement')) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payement = Payement::findOrFail($id);

        return view('back.payements.edit',compact('payement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payement = Payement::findOrFail($id);

        $this->validate($request,
        [
           'user_id' => ['required', 'string', 'exists:users,id'],
           'formation_id' => ['required', 'string', 'exists:formations,id'],
           'carte_id' => ['required', 'string', 'exists:cartes,id'],
           'montant' => 'required|between:0,99.99'
        ]);

        $payement->update([
            'user_id' => $request->user_id,
            'formation_id' => $request->formation_id,
            'carte_id' => $request->carte_id,
            'montant_paye' => $request->montant
        ]);

        return redirect()->route('admin.payements.index')->with('status', 'Payement modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payement = Payement::findOrFail($id);

        $payement->delete();
        return back()->with('status', 'Payement supprimé');
    }
}
