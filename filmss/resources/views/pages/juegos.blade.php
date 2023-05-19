@extends('layouts.master')
@section('title') JUEGOS @endsection
@section('contenido')
    <div class="bg-green2" style="height: calc(100% - 131px); min-height: calc(100vh - 131px);">
        <div class="container pt-[60px] flex-col text-[48px] flex justify-center text-yellow align-items-center">
            <img class="w-42 h-24" src="{{asset('images/logo_rolloAmarillo.png')}}" alt="logo"><span class="tracking-widest">FILMSSPLAY</span>
            <p class="mt-4 text-blanco text-[22px]">Adivina las peliculas, series... en estos divertidisimos juegos</p>
        </div>
        <div class="container flex justify-around mt-[100px]">
            <a href="" class="w-1/4 no-underline text-blanco">
                <div class="botonJuego flex flex-col outline-0 border-1 border-solid border-yellow justify-center align-items-center pr-14 h-60 rounded-[15px] gap-5"
                     style="background-image:linear-gradient(rgb(236,180,45,0.2),rgb(236,180,45,0.2)),url('images/juegos/ahorcado.png');
                      background-position: 0,160px; background-repeat: no-repeat;background-size:100%,170px;">
                    <span class="text-[32px] font-bold">Ahorcado</span>
                    <span>Adivina la película,serie...</span>
                </div>
            </a>
            <a href="" class="w-1/4 no-underline text-blanco">
                <div class="botonJuego flex flex-col outline-0 border-1 border-solid border-yellow justify-center align-items-center pr-14 h-60 bg-yellow2 rounded-[15px] gap-5"
                     style="background-image:linear-gradient(rgb(236,180,45,0.2),rgb(236,180,45,0.2)),url('images/juegos/avatarposter.jpg');
                      background-position: 0,210px; background-repeat: no-repeat;background-size:100%,70px; border-radius: 15px">
                    <span class="text-[32px] font-bold">Posters</span>
                    <span>Solo con el poster <br>adivina de que peli se trata</span>
                </div>
            </a>
            <a href="" class="w-1/4 no-underline text-blanco">
                <div class="botonJuego flex flex-col outline-0 border-1 border-solid border-yellow justify-center align-items-center pr-14 h-60 bg-yellow2 rounded-[15px] gap-5"
                     style="background-image:linear-gradient(rgb(236,180,45,0.2),rgb(236,180,45,0.2)),url('images/juegos/feliz.png');
                      background-position: 0,200px; background-repeat: no-repeat;background-size:100%,100px;">
                    <span class="text-[32px] font-bold">Emojis</span>
                    <span>Descubre la película o <br>serie con solo unos emojis</span>
                </div>
            </a>
        </div>
    </div>
@endsection
