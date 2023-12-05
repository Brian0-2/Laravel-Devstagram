@extends('layouts.app')

@section('titulo')
Editar Perfil: {{auth() -> user() -> username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
        <form method="POST" action="{{route('perfil.store')}}" enctype="multipart/form-data" class="mt-10 md:mt-0" novalidate>
            @csrf
            @if (session('mensaje'))
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                {{session('mensaje')}}
            </p> 
            @endif
            <div class="mb-5">
                {{-- margin-bottom: 2 / display: block / text-transform: uppercase /color: gray opacity:1 /font-weight: 700 --}}
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                    User Name
                </label>
                <input  
                        id="username"
                        name="username"
                        type="text" 
                        placeholder="Tu Nombre de usuario"
                        {{-- border:1px solid / padding:3 / width:100% / border-radious --}}
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ auth() -> user() -> username }}"
                />
                @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>{{--EndLabel--}}
            <div class="mb-5">
                {{-- margin-bottom: 2 / display: block / text-transform: uppercase /color: gray opacity:1 /font-weight: 700 --}}
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                    User Email
                </label>
                <input  
                        id="email"
                        name="email"
                        type="email" 
                        placeholder="Tu Correo es Obligatorio"
                        {{-- border:1px solid / padding:3 / width:100% / border-radious --}}
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ auth() -> user() -> email }}"
                />
                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>{{--EndLabel--}}
            <div class="mb-5">
                {{-- margin-bottom: 2 / display: block / text-transform: uppercase /color: gray opacity:1 /font-weight: 700 --}}
                <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                    Imagen perfil
                </label>
                <input  
                        id="imagen"
                        name="imagen"
                        type="file" 
                        class="border p-3 w-full rounded-lg"
                        value=""
                        accept=".jpg, .jpeg, .png"
                />
            </div>{{--EndLabel--}}
            <div class="mb-5">
                {{-- margin-bottom: 2 / display: block / text-transform: uppercase /color: gray opacity:1 /font-weight: 700 --}}
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                   User Password
                </label>
                <input  
                        id="password"
                        name="password"
                        type="password" 
                        placeholder="Password para poder Modificar"
                        {{-- border:1px solid / padding:3 / width:100% / border-radious --}}
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                />
                @error('password')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>{{--EndLabel--}}
            <input  type="submit" 
            value="Guardad Cambios"
            class="bg-sky-600 hover:bg-sky-700 
                    transition-colors cursor-pointer uppercase 
                    font-bold w-full p-3 text-white rounded-lg"
    />
        </form>
    </div>
@endsection