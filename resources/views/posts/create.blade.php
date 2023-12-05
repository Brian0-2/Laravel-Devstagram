@extends('layouts.app')

@section('titulo')
    Crea una nueva Publicacion
@endsection
{{-- Cargar hojas de estilos o archivos javascript de otro archivo , en este caso de /app.blade.php --}}
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
    <div class="md:flex md:items-center mt-2">
        <div class="md:w-1/2 px-10">
            <form action="{{ route('imagenes.store') }}" id="dropzone"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center"
                method="POST" enctype="multipart/form-data">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Titulo
                    </label>
                    <input id="titulo" name="titulo" type="text" placeholder="Titulo de la publicacion"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                        value="{{ old('titulo') }}" />
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>{{-- EndLabel --}}
                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripcion
                    </label>
                    <textarea id="descripcion" name="descripcion" placeholder="Descripcion de la publicacion"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>{{-- EndLabel --}}
                <div class="mb-5">
                    <input name="imagen" type="hidden" value="{{ old('imagen') }}" />
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" value="Crear Publicacion"
                    class="bg-sky-600 hover:bg-sky-700 
                        transition-colors cursor-pointer uppercase 
                        font-bold w-full p-3 text-white rounded-lg" />
            </form>
        </div>
    </div>
@endsection
