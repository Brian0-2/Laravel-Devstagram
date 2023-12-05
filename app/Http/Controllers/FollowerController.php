<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //
    public function store(Request $request , User $user){
        //Utilizamos el metodo que viene del modelo Follower
        $user -> followers() -> attach(auth() -> user() -> id);
        return back();
    }

    public function destroy(Request $request , User $user){
        //Utilizamos el metodo que viene del modelo Follower y utilizamos detach para eliminar el registro que no viene por convencion de laravel
        $user -> followers() -> detach(auth() -> user() -> id);
        return back();
    }
}
