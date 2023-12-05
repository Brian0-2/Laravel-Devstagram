<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user , Post $post){
        //Validar
        $this -> validate($request,[
            'comentario' => 'required|max:255'
        ]);

        //Almacenar el comentario
        Comentario::create([
            'user_id' => auth() -> user() -> id,
            'post_id' => $post -> id,
            'comentario' => $request -> comentario
        ]);

        //imprimir
        //back = Esto quiere decir que regrese a la pagina anterior o a la que se hace el comentario
        //with = para mostrar datos 
        return back() -> with('mensaje','Comentario Realizado Correctamente');

       }
}
