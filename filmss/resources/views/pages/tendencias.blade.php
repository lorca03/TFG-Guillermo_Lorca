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
        <div class="container flex flex-col text-[38px] align-items-start pt-[45px] text-blanco" id="peliculas">
            <div class="flex">Peliculas<img class="ml-[8px] w-16 h-16" src="{{ asset('images/Claqueta.png') }}" alt="fuegito"></div>
            <div id="carouselPelisControls" class="carousel slide mt-3">
                <div class="carousel-inner">
                    @php
                        $chunks = array_chunk($peliculas, 5);
                        $totalChunks = count($chunks);
                    @endphp

                    @foreach($chunks as $index => $chunk)
                        <div class="carousel-item {{$index === 0 ? 'active' : ''}}">
                            <div class="row flex align-items-center justify-center">
                                @foreach($chunk as $pelicula)
                                    <div class="col-md-2">
                                        <img src="https://image.tmdb.org/t/p/original/{{ $pelicula['poster_path'] }}"
                                             class="w-[300px] rounded-[10px]" alt="{{$pelicula['title']}}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev {{$totalChunks == 1 ? 'd-none' : ''}}" type="button" data-bs-target="#carouselPelisControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next {{$totalChunks == 1 ? 'd-none' : ''}}" type="button" data-bs-target="#carouselPelisControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="container flex flex-col text-[38px] align-items-start pt-[45px] text-blanco" id="peliculas">
            <div class="flex">Series<img class="ml-[8px] w-18 h-12" src="{{ asset('images/FotoVideo.png') }}" alt="fuegito"></div>
            <div id="carouselSeriesControls" class="carousel slide mt-3">
                <div class="carousel-inner">
                    @php
                        $chunks = array_chunk($series, 5);
                        $totalChunksS = count($chunks);
                    @endphp

                    @foreach($chunks as $index => $chunk)
                        <div class="carousel-item {{$index === 0 ? 'active' : ''}}">
                            <div class="row flex align-items-center justify-center">
                                @foreach($chunk as $serie)
                                    <div class="col-md-2">
                                        <img src="https://image.tmdb.org/t/p/original/{{ $serie['poster_path'] }}"
                                             class="w-[300px] rounded-[10px]" alt="{{$serie['name']}}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev {{$totalChunksS == 1 ? 'd-none' : ''}}" type="button" data-bs-target="#carouselSeriesControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next {{$totalChunksS == 1 ? 'd-none' : ''}}" type="button" data-bs-target="#carouselSeriesControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <script>
    </script>
@endsection
