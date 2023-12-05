@extends('layouts.app')

@section('titulo')
    Inicia sesion en Devstagram
@endsection

@section('contenido')
    {{-- media query 768px --}}
    <div class="md:flex md:justify-center mt-10 md:gap-10 md:items-center">
        {{-- media query 4 de 12 columnas --}}
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg')}}" alt="Imagen login de usuarios">
        </div>

        {{-- media query 4 de 12 columnas --}}
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form method="POST" action="{{route('login')}}" novalidate>
                @csrf
                @if (session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{session('mensaje')}}
                </p> 
                @endif
                   {{-- margin-bottom:5--}}
                   <div class="mb-5">
                    {{-- margin-bottom: 2 / display: block / text-transform: uppercase /color: gray opacity:1 /font-weight: 700 --}}
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input  
                            id="email"
                            name="email"
                            type="email" 
                            placeholder="Tu Email de Registro"
                            {{-- border:1px solid / padding:3 / width:100% / border-radious --}}
                            class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                            value="{{ old('email') }}"
                    />
                    @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>{{--EndLabel--}}

                 {{-- margin-bottom:5--}}
                 <div class="mb-5">
                    {{-- margin-bottom: 2 / display: block / text-transform: uppercase /color: gray opacity:1 /font-weight: 700 --}}
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input  
                            id="password"
                            name="password"
                            type="password" 
                            placeholder="Password de Registro"
                            {{-- border:1px solid / padding:3 / width:100% / border-radious --}}
                            class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                    />
                    @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>{{--EndLabel--}}

                <div class="mb-5">
                    <input type="checkbox" name="remember"> <label class="text-gray-500 text-sm">mantener mi session abierta</label>
                </div>

                <input  type="submit" 
                        value="Iniciar Sesion"
                        class="bg-sky-600 hover:bg-sky-700 
                                transition-colors cursor-pointer uppercase 
                                font-bold w-full p-3 text-white rounded-lg"
                />

            </form>
        </div>
    </div>
@endsection