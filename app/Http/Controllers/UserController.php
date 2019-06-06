<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use App\User;

class UserController extends Controller
{
    public function index(){
        $users = User::paginate();

        return view('users.index',compact('users'));
    }

    public function store(Request $request){
        $user = User::create($request->all());
        return redirect()->route('users.edit',$user->id)
        ->with('info','Usuario guardado con éxito');
    }

    public function show(User $user){
        // $user = User::find($id);
        return view('users.show',compact('user'));
    }

    public function edit(User $user){
        // $user = User::find($id);
        $roles = Role::get();
        return view('users.edit',compact('user','roles'));
    }

    public function update(Request $request,User $user){
        // $user = User::find($id);
        $user->update($request->all());
        $user->roles()->sync($request->get('roles'));  

        return redirect()->route('users.edit',$user->id)
        ->with('info','Usuario guardado con éxito');
    }

    public function destroy(User $user){
        $user->delete();
        return back()->with('info','Eliminado correctamente');
    }
}
