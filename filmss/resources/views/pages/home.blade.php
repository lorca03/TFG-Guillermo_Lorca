@extends('layouts.master')
@section('title') Home @endsection
@section('contenido')

    <div class="contenedor_buscador flex justify-center align-items-center w-100 h-80 min-h-min bg-center bg-cover bg-no-repeat" style="background-image:linear-gradient(rgb(236,180,45,0.6),rgb(236,180,45,0.6)),url('{{ asset("images/avatar.png") }}');">

        <div class="container text-green text-5xl font-bold">
            Bienvenido a FILMSS <br>
            <p class="text-3xl font-normal [text-shadow:_0_3px_4px_rgb(1_43_41_/_40%)]">Descubre nuevas películas, series y personas. Explora y disfruta.</p>
            <form action="">
            <div class="buscador relative inline-flex mt-8 w-100 text-xl font-normal">
                <input type="text" id="inputBuscador" class="bg-green2 font- rounded-[50px] text-blanco p-[35px] h-10 w-full placeholder-white" placeholder="&#xf002; Buscar peliculas, programas de televisión, personas...">
{{--                <img src="{{ asset("images/lupa-blanca.png") }}" class="absolute h-6 left-7 top-6"  alt="lupa">--}}
                <button type="submit" class="absolute rounded-[50px] right-0 p-[35px] h-10 top-0 bg-yellow hover:text-white flex items-center">Explora</button>
            </div>
            </form>
        </div>
    </div>
    <div class="contenedor_busqueda bg-green w-100 h-[1500px]">
        <div class="container text-blanco flex justify-center pt-20">
            <ul class="l_homeF flex justify-between text-[30px]">
                <li><a class="no-underline text-blanco hover:text-yellow " href="#">Todo</a></li>
                <li><a class="no-underline text-blanco hover:text-yellow" href="#">Películas</a></li>
                <li><a class="no-underline text-blanco hover:text-yellow" href="#">Series</a></li>
                <li><a class="no-underline text-blanco hover:text-yellow" href="#">TV Shows</a></li>
            </ul>
        </div>
        <div class="container text-green flex justify-center gap-[80px] pt-14">
            <button type="submit" class="filtroModal">Género</button>
            <button type="submit" class="filtroModal">Puntuación</button>
            <button type="submit" class="filtroModal">Idioma</button>
            <button type="submit" class="filtroModal">Duración</button>
            <button type="submit" class="filtroModal">País</button>
        </div>
        <div class="container-fluid flex justify-center gap-[10px] pt-14">
                <?php
                    for ($i = 0; $i < 20; $i++){
                ?>
                <div class="rounded-[15px]"><a href="#" class=""><img class="h-14 w-14 rounded-[15px]" src="{{ asset("images/netflix.png") }}" alt="Perfil"></a></div>
                <?php
                    }
                ?>
        </div>
    </div>

@endsection
