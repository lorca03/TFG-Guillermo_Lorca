@extends('layouts.master')
@section('title') TENDENCIAS @endsection
@section('contenido')

    <div class="w-100 h-[500px] flex justify-center flex-col align-items-center bg-center bg-cover bg-no-repeat"
         style="background-image:linear-gradient(rgb(1,43,41,0.6),rgb(1,43,41,0.5)),url('{{ $imagen_aleatoria }}');">
        <div class="titulo text-center bg-transparent text-yellow text-[72px]" style="-webkit-text-stroke: 1px white; text-stroke: 1px white;">
            FILMSS</div>
        <div class="container flex justify-center text-[18px] align-items-center">
            <p class="text-blanco text-center">¡¡Descubre lo último y más popular!!<br>
                Mantente al día con las últimas tendencias <br>
                y descubre lo que todo el mundo está viendo</p>
        </div>
        <a class="bg-yellow p-3 text-[20px] no-underline text-blanco rounded-[10px]" href="#tendencias" >Tendencias</a>
    </div>
    <div class=" bg-green w-100 h-[1000px]" id="tendencias">
        <div class="container pt-[45px] flex justify-center text-[38px] align-items-center text-blanco">
            Tendencias <img class="ml-[8px] w-14 h-16" src="{{ asset('images/Fuego.png') }}" alt="fuegito"></div>
        <div class="container flex text-[38px] align-items-center pt-[45px] text-blanco" id="peliculas">
            Peliculas<img class="ml-[8px] w-16 h-16" src="{{ asset('images/Claqueta.png') }}" alt="fuegito">
        </div>
        <div class="container flex text-[38px] align-items-center pt-[45px] text-blanco" id="peliculas">
            Series<img class="ml-[8px] w-18 h-12" src="{{ asset('images/FotoVideo.png') }}" alt="fuegito">
        </div>
    </div>
@endsection
