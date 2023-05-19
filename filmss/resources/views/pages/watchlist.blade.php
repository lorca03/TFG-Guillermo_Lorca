@extends('layouts.master')
@section('title') WATCHLIST @endsection
@section('contenido')

    @auth
        {{--Pantalla para cuando no hay ningun contenido en la Watchlist de un usuario--}}
            <div class="bg-green2" style="height: calc(100% - 243px); min-height: calc(100vh - 243px);">
                <div class="container flex flex-col justify-center align-items-center text-blanco text-[40px] pt-16">
                    <img class="w-22 h-24" src="{{asset('images/logo_rolloAmarillo.png')}}" alt="Logo">¡Agrega tus primeros títulos ahora!<br>
                   <p class="text-center text-[20px] mt-4">Comienza a disfrutar de la <br>
                       experriencia FILMSS.<br>
                       Añade tus peliculas, series, <br>
                       personas... de interes</p>
                    <a href="/tendencias" class="mt-5 no-underline text-green bg-yellow p-3 text-[24px] rounded-[10px]"
                       style="box-shadow: 0px 4px 4px #012b29; text-shadow: 0px 1px 4px #012b29;">Añadir Ahora</a>
                </div>
            </div>
    @elseauth
        {{--Pantalla de inicio de la Watchlist, para cuendo noe stas logeado--}}
        <div class="w-100 pb-6 flex justify-center flex-col align-items-center bg-center bg-yellow bg-cover bg-no-repeat"
             style="background-image:url('{{ asset('images/watchlist/CamaraWatchlist.png') }}'),url('{{ asset('images/watchlist/PaloyBebida.png') }}'),
         url('{{ asset('images/watchlist/Tickets.png') }}'),url('{{ asset('images/watchlist/Rollo.png') }}'),
         linear-gradient(rgb(236, 180, 45) ,rgb(1,43,41,0.8)); background-position:top right, top left,bottom right, bottom left;
         background-size:610px,610px,600px,610px,100%; height: calc(100% - 243px); min-height: calc(100vh - 243px);">
            <div class="titulo tracking-widest mb-2 flex flex-col justify-center align-items-center text-green text-[90px]">
                <img class="mb-[-10px] w-26 h-24" src="{{ asset('images/logo_verde.png') }}" alt="Logo">FILMSS</div>
            <div class="container flex justify-center mb-4 align-items-center text-[20px] text-blanco text-center">
                ¿Alguna vez has querido guardar <br>
                todo lo que deseas ver en un solo lugar? <br>
                ¡Hazlo ya con tu WatchList!
            </div>
            <a class="bg-green2 mt-2 p-3 text-[20px] no-underline text-blanco rounded-[10px]" href="/sign_up" >Inicia Sesión</a>
        </div>
    @endauth



@endsection
