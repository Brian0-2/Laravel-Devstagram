<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index()
    {
        // /resources/auth/register.blade.php
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //dd($request ->get('username'));

        //Modificar el request
        $request -> request -> add(['username' => Str::slug($request -> username)]);
        //validacion
        $this -> validate($request,[
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        //Crear Usuario
        //slug elimina los espacios y combierte los caracteres a minusculas
        //lower combierte los string a minusculas
       User::create([
            'name' =>$request -> name,
            'username' => $request -> username,
            'email' => $request -> email,
            'password' => Hash::make( $request -> password)
       ]);

       //Autenticar Usuario
    //    auth() -> attempt([
    //         'email' => $request -> email,
    //         'password' => $request -> password
    //    ]);

       //Otra forma de autenticar
        auth() -> attempt($request -> only('email', 'password'));
       //Redireccionar Usuario
       return redirect() -> route('posts.index',auth() -> user());
    }
}
