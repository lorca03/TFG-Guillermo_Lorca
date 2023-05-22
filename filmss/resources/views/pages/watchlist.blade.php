@extends('layouts.master')
@section('title')
    WATCHLIST
@endsection
@section('contenido')

    @auth
        @if(Auth::user()->registrosWatchlist()->exists())
            {{--Pantalla para mostrar el contenido de la Watchlist--}}
            <div class="bg-green2" style="height: calc(100% - 243px); min-height: calc(100vh - 243px);">
                @if($error)
                    <div class="container">
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    </div>
                @endif
                <div class="container-fluid pt-9" style="padding-left: 64px;padding-right: 64px;max-width: 1752px;">
                    <div class="row">
                        <div class="col-6 flex text-[20px] align-items-center justify-start">
                            <a href=""
                               class="bg-yellow text-green rounded-[10px] pt-3 pb-3 pl-6 pr-6 mr-4 no-underline flex">
                                <img class="w-[25px]" src="{{asset('images/watchlist/guardarRe.png')}}"
                                     alt="Icono"><span class="pl-1">Watchlist</span></a>
                            <a href=""
                               class="bg-yellow text-green rounded-[10px] pt-3 pb-3 pl-7 pr-7 mr-4 no-underline flex">
                                <img class="w-[30px]" src="{{asset('images/watchlist/checkVerde.png')}}"
                                     alt="Icono"><span class="pl-1">Vista</span></a>
                            <a href=""
                               class="bg-yellow text-green rounded-[10px] pt-3 pb-3 pl-7 pr-7 mr-4 no-underline flex ">
                                <img class="w-[40px]" src="{{asset('images/watchlist/logo_rolloVerde.png')}}"
                                     alt="Icono"><span class="pl-1">Valorada</span></a>
                        </div>
                    </div>
                    <div class="row pb-4 justify-center mt-5">
                        @foreach ($responseData as $result)
                            @php
                                $image_path = isset($result['poster_path']) ? $result['poster_path'] :
                                              (isset($result['profile_path']) ? $result['profile_path'] :
                                              (isset($result['backdrop_path']) ? $result['backdrop_path'] : false));
                                $image_name = isset($result['title']) ? 'title' : 'name';
                                $slug = Str::slug($result[$image_name]);
                            @endphp
                            <div class="col-sm-12 text-green col-md-6 col-lg-4 mb-3">
                                <form method="POST" class="w-full flex">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$result['id']}}">
                                    @if($image_path)
                                        <div
                                            class="h-[310px] w-48 sm:w-56 flex-none bg-cover rounded-tl-[10px] rounded-bl-[10px] text-center overflow-hidden"
                                            style="background-image: url('https://image.tmdb.org/t/p/w400/{{ $image_path }}')"
                                            title="{{$result[$image_name]}}">
                                        </div>
                                    @else
                                        <div
                                            class="bg-gray-300 h-[310px] rounded-tl-[10px] rounded-bl-[10px]">
                                            <img src="{{asset('images/no-image-slide.png')}}"
                                                 class="w-[166px] h-[249px] "></div>
                                    @endif
                                    <div
                                        class="p-4 h-[310px] text-green rounded-tr-[10px] rounded-br-[10px] flex flex-col justify-between bg-yellow">
                                        <div class="font-bold text-xl mb-2">{{$result[$image_name]}}</div>
                                        <div class="container text-[20px]">
                                            <div class="row">
                                                <div class="col-12 mr-1 mb-3 flex justify-center w-auto align-items-center"
                                                     style="border:1px solid #012b29;border-radius:10px;box-shadow:0px 4px 4px #012b29;">
                                                    <form action="" class="mb-1" method="post">
                                                        <button type="submit" class="flex align-items-center">
                                                            <img class="w-[25px]"
                                                                 src="{{asset('images/watchlist/checkVerde.png')}}"
                                                                 alt="Icono"><span class="ml-1">Vista</span>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="col-12 mb-3 flex justify-center w-auto align-items-center"
                                                     style="border:1px solid #012b29;border-radius:10px;box-shadow:0px 4px 4px #012b29;">
                                                    <form action="" class="mb-1" method="post">
                                                        <button type="submit" class="flex align-items-center">
                                                            <img class="w-[35px]"
                                                                 src="{{asset('images/watchlist/logo_rolloVerde.png')}}"
                                                                 alt="Icono"><span class="ml-1">Valorar</span>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="col-12 p-1 flex justify-center w-auto align-items-center"
                                                     style="border:1px solid #012b29;border-radius:10px;box-shadow:0px 4px 4px #012b29;">
                                                    <form action="{{route('quitarContenido')}}" class="mb-1" method="post">@csrf
                                                        <input type="hidden" name="contenido" value="{{$result[0]}}/{{$result['id']}}">
                                                        <button type="submit" class="flex align-items-center">
                                                            <img class="w-[30px]"
                                                                 src="{{asset('images/watchlist/guardarRe.png')}}"
                                                                 alt="Icono"><span class="ml-1">Quitar Watchlist</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        @else
            {{--Pantalla para cuando no hay ningun contenido en la Watchlist de un usuario--}}
            <div class="bg-green2" style="height: calc(100% - 243px); min-height: calc(100vh - 243px);">
                <div class="container flex flex-col justify-center align-items-center text-blanco text-[40px] pt-16">
                    <img class="w-22 h-24" src="{{asset('images/logo_rolloAmarillo.png')}}" alt="Logo">¡Agrega tus
                    primeros títulos ahora!<br>
                    <p class="text-center text-[20px] mt-4">Comienza a disfrutar de la <br>
                        experriencia FILMSS.<br>
                        Añade tus peliculas, series, <br>
                        personas... de interes</p>
                    <a href="/tendencias" class="mt-5 no-underline text-green bg-yellow p-3 text-[24px] rounded-[10px]"
                       style="box-shadow: 0px 4px 4px #012b29; text-shadow: 0px 1px 4px #012b29;">Añadir Ahora</a>
                </div>
            </div>
        @endif
    @else
        {{--Pantalla de inicio de la Watchlist, para cuendo no estas logeado--}}
        <div
            class="w-100 pb-6 flex justify-center flex-col align-items-center bg-center bg-yellow bg-cover bg-no-repeat"
            style="background-image:url('{{ asset('images/watchlist/CamaraWatchlist.png') }}'),url('{{ asset('images/watchlist/PaloyBebida.png') }}'),
         url('{{ asset('images/watchlist/Tickets.png') }}'),url('{{ asset('images/watchlist/Rollo.png') }}'),
         linear-gradient(rgb(236, 180, 45) ,rgb(1,43,41,0.8)); background-position:top right, top left,bottom right, bottom left;
         background-size:610px,610px,600px,610px,100%; height: calc(100% - 243px); min-height: calc(100vh - 243px);">
            <div
                class="titulo bg-transparent tracking-widest mb-2 flex flex-col justify-center align-items-center text-green text-[90px]">
                <img class="mb-[-10px] w-26 h-24" src="{{ asset('images/logo_verde.png') }}" alt="Logo">FILMSS
            </div>
            <div class="container flex justify-center mb-4 align-items-center text-[20px] text-blanco text-center">
                ¿Alguna vez has querido guardar <br>
                todo lo que deseas ver en un solo lugar? <br>
                ¡Hazlo ya con tu WatchList!
            </div>
            <a class="bg-green2 mt-2 p-3 text-[20px] no-underline text-blanco rounded-[10px]" href="/sign_up">Inicia
                Sesión</a>
        </div>
    @endauth

@endsection
