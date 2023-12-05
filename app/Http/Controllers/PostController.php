<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function __construct()
    {
        //Porteger vista , except es para no restringir metodos
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user)
    {
        //->get es para traerme los resultados de la url
        //simplePaginate es otro tipo de paginacion.
        //latest es para ordenar del ultimo registro al primero
        $posts = Post::where('user_id', $user->id)-> latest() ->paginate(20);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    //Retornar vista
    public function create()
    {
        return view('posts.create');
    }

    //Guardar en la base de datos
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // Post::create([
        //     'titulo' => $request -> titulo,
        //     'descripcion' => $request -> descripcion,
        //     'imagen' => $request -> imagen,
        //     'user_id' => auth()->user() -> id
        // ]);

        //Otra forma de crear registros
        // $post = new Post();
        // $post -> titulo = $request->titulo;
        // $post -> descripcion = $request->descripcion;
        // $post -> imagen = $request->imagen;
        // $post -> user_id = auth()->user() -> id;
        // $post -> save();

        //Otra forma de crear registros
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    // Eliminar publicacion 
    public function destroy(Post $post)
    {
        //Comprobacion de Polici en el archivo APP/policie
        $this->authorize('delete', $post);
        // $post->delete();

        //Eliminar la imagen
        $imagen_path = public_path('uploads/'. $post -> imagen);
        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }
        return redirect() -> route('posts.index', auth() -> user() -> username);
    }
}
