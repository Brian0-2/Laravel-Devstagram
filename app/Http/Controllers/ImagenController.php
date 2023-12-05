<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        //Obtener la imagen del input File
        $imagen = $request->file('file');

        //Darle un nombre unico a la imagen
        $nombreImagen = Str::uuid() . "." . $imagen -> extension();

        //Crear la imagen
        $imagenServidor = Image::make($imagen);
        //Si es mas grande de 1000px la recorta
        $imagenServidor-> fit(1000,1000);

        //Crear la carpeta llamada uploads
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        
        //Guardar la imagen a la carpeta
        $imagenServidor -> save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
