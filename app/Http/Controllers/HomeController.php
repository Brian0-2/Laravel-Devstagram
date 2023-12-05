<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        //Revisar que los usuarios esten autenticados para poder ver las publicaciones
        $this->middleware('auth');
    }

    //Solo se utilizan cuando solo quiero tener un metodo en este caso solo mostrar la vista con los post de cada usuario que sigues
    public function __invoke()
    {

        //Obtener a quienes seguimos
        //metodo followings se encuentra en el modelo User
        //ToArray me convierte el objeto User a un arreglo de strings
        //Con pluck me traego del objeto User solo el id ya convertido en arreglo por toArray()
        //latest es para ordenar del ultimo registro al primero

        $ids = auth()->user()->followings->pluck('id')->toArray();
        //whereIn revisa de un valor de tu base de datos , multiples datos pasados en un arreglo
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        return view('home', [
            'posts' => $posts
        ]);
    }
}
