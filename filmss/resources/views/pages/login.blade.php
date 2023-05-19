@extends('layouts.master')
@section('title')
    INICIO DE SESIÓN
@endsection
@section('contenido')
    <div class="flex h-screen">
        <div
            class="bg-green w-1/2 tracking-widest h-screen text-[72px] flex justify-center align-items-center flex-col">
            <a href="/" class="no-underline flex justify-center flex-col align-items-center text-yellow">
                <img class="w-42 h-24" src="{{asset('images/logo_rolloAmarillo.png')}}" alt="Home">FILMSS</a>
        </div>
        <div class="bg-yellow text-green w-1/2 text-[28px] h-screen flex justify-center align-items-center flex-col">
            <span class="text-[72px] mb-3">!Bienvenido!</span>
            Inicia sesión en FILMSS y comienza <br>
            a explorar nuestro amplio catálogo <br>
            de entretenimiento en línea.
            <form action="{{route('inicio.sesion')}}" method="POST">
                @csrf
                <div class="flex mt-5 text-[24px] flex-col space-y-8 w-96">
                    <input type="email" name="email"
                           class="rounded-[10px] focus:outline-0 placeholder-yellow p-3 bg-green text-yellow"
                           placeholder="Correo Electrónico">
                    <input type="password" name="password"
                           class="rounded-[10px] focus:outline-0 placeholder-yellow p-3 bg-green text-yellow"
                           placeholder="Contraseña">
                    <div class="flex flex-col align-items-center">
                        <button type="submit" class="bg-green text-yellow w-1/2 p-3 rounded-[10px]">Inicia Sesión
                        </button>
                        <span class="mt-2 text-green text-center text-[12px]">¿No estas registrado?<a href="/sign_up"
                                                                                                      class="hover:font-extrabold font-bold no-underline text-green">Regístrate</a></span>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
