@extends('layouts.master')
@section('title') REGISTRARSE @endsection
@section('contenido')
    <div class="flex h-screen">
        <div class="bg-yellow w-1/2 tracking-widest h-screen text-[72px] flex justify-center align-items-center flex-col" >
            <a href="/" class="no-underline flex justify-center flex-col align-items-center text-green"><img class="w-42 h-24" src="{{asset('images/logo_verde.png')}}" alt="Home">FILMSS</a>
        </div>
        <div class="bg-green text-yellow w-1/2 text-[28px] h-screen flex justify-center align-items-center flex-col">
            <span class="text-[72px] mb-3">¡Crea tu cuenta!</span>
            ¡Regístrate ahora en FILMSS y descubre una <br>
            amplia selección de películas, series... <br>
            Tendrás todo lo que necesitas en un solo lugar
            <form action="{{route('registro')}}" method="POST">
                @csrf
                <div class="flex mt-5 text-[24px] flex-col space-y-8 w-96">
                    <input type="text" required name="nombre" class="rounded-[10px] focus:outline-0 placeholder-green p-3 bg-yellow text-green" placeholder="Nombre">
                    <input type="email" required name="email" class="rounded-[10px] focus:outline-0 placeholder-green p-3 bg-yellow text-green" placeholder="Correo Electrónico">
                    <input type="password" title="*Debe contener al menos una letra minúscula, una letra mayúscula y un número"
                           required name="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$" minlength="8" class="rounded-[10px] focus:outline-0 placeholder-green p-3 bg-yellow text-green" placeholder="Contraseña">
                    <div class="flex flex-col align-items-center">
                        <button type="submit" class="bg-yellow text-green w-1/2 p-3 rounded-[10px]">Regístrate</button>
                        <span class="mt-2 text-yellow text-center text-[12px]">¿Ya tienes cuenta?<a href="/login" class="font-bold no-underline text-yellow">Inicia Sesión</a></span>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
