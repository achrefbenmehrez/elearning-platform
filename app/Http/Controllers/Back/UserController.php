<?php

namespace App\Http\Controllers\Back;

use App\Models\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('back.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('back.users.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'nom_utilisateur' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => 'required',
                'role' => 'required|exists:roles,name',
                'preference' => ''
            ]
        );

        $user = User::create(
            [
                'nom_utilisateur' => $request->nom_utilisateur,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'notification_preference' => implode(',', $request->preference)
            ]
        );

        $user->assignRole($request->role);
        return redirect()->route('admin.users.index')->with('status', 'Utilisateur cree');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('back.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('back.users.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate(
            $request,
            [
                'nom_utilisateur' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'role' => 'required|exists:roles,name',
                'preference' => ''
            ]
        );

        $user->update([
            'nom_utilisateur' => $request->nom_utilisateur,
            'email' => $request->email,
            'notification_preference' => implode(',', $request->preference)
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')->with('status', 'Utilisateur modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('status', 'Utilisateur ' . $user->nom_utilisateur . 'supprimé');
    }
}
