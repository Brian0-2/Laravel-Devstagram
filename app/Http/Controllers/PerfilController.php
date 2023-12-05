<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //Protejer la ruta
    public function __construct()
    {
        //Protejer la ruta
        $this->middleware('auth');
    }
    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {

        $request->request->add(['username' => Str::slug($request->username)]);

        //Si la validacion es de mas de 3, se recomienda colocarlos en un arreglo segun laravel
        $this->validate($request, [
            'username' => [
                //Obligatorio
                'required',
                //Verificamos si el usuario que esta editando es el mismo que esta en la DB , pueda colocar su mismo nombre
                //en caso contrario que no agregue un nombre ya existente con ayuda de auth()->user()->id
                'unique:users,username,' . auth()->user()->id,
                //Minimo de 3 caracteres
                'min:3',
                //Maximo de 3 caracteres
                'max:20',
                //Esto ayuda a que no haya nombres que no queramos especificos
                // 'not_in:twitter,editar-perfil',
                //Esto ayuda a forsar que coloquen nombresespecificos a sus registros
                // 'in:CLIENTE,VENDEDOR'
            ],
            'email' => [
                'required',
                'unique:users,email,' . auth()->user()->id,
            ],
            'password' => [
                'required',
                'min:6',
            ],
        ]);

        //Verificar que la password actual sea la correcta
        if (!auth()->validate(['email' => auth()->user()->email, 'password' => $request->password])) {

            //Devuelvete a login pero con un mensaje de error
            return back()->with('mensaje', 'Password Actual Incorrecto');
        }

         if ($request->imagen) {
             //Obtener la imagen del input File
           $imagen = $request->file('imagen');

           //Darle un nombre unico a la imagen
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            //Crear la imagen
            $imagenServidor = Image::make($imagen);
            //Si es mas grande de 1000px la recorta
             $imagenServidor->fit(1000, 1000);

             //Crear la carpeta llamada uploads
           $imagenPath = public_path('perfiles') . '/' . $nombreImagen;

           //Guardar la imagen a la carpeta
            $imagenServidor->save($imagenPath);
        }
         //Guardar cambios
       $usuario = User::find(auth()->user()->id);
       $usuario->username = $request->username;
       $usuario->imagen = $nombreImagen ?? auth()-> user()-> imagen ?? null;

       $usuario->save();

       //Redireccionar al usuario
       return redirect()->route('posts.index', $usuario->username);
    }
}
