@extends('layouts.master')
@php($image_name = isset($datos['title']) ? 'title' : 'name')
@section('title')
    {{$datos[$image_name]}}
@endsection
@section('contenido')

    @if($tipo=='person')
        <div class="bg-green2 w-100"
             style="height: calc(100% - 131px); min-height: calc(100vh - 131px); min-width: 50%">
            <div class="container">
                <div class="row">
                    <div class="col flex align-items-center justify-center">
                        <img src="https://image.tmdb.org/t/p/w400/{{ $datos['profile_path'] }}"
                             class="rounded-[15px] h-4/5" alt="{{$datos[$image_name]}}">
                    </div>
                    <div class="col flex flex-col text-blanco items-start text-[20px] pt-[60px]">
                        <span class="text-[40px]">{{$datos[$image_name]}}</span>
                        <span class="text-yellow mt-3 text-[25px]">Biografia</span>
                        <p class="mt-2 text-[16px]">
                            {{substr($datos['biography'],0,strlen($datos['biography'])/3)}}
                            <span class="hidden extra-content">
                                {{substr($datos['biography'],strlen($datos['biography'])/3)}}
                            </span>
                        </p>
                        <div class="flex w-100 mt-[-30px] justify-end">
                            <button class="flex-end ml-1/2 text-yellow hover:text-blanco font-bold py-2 px-4 rounded read-more">
                                Leer más >
                            </button>
                            <button class=" text-yellow hover:text-blanco font-bold py-2 px-4 rounded hidden read-less">
                                Leer menos <
                            </button>
                        </div>
                        <div class="row text-yellow">
                            <span class="text-[25px] mb-2">Informacion Personal</span>
                            <div class="col-6 mb-2">Conocido por <br><span class="text-blanco">{{$datos['known_for_department']}}</span></div>
                            <div class="col-6 mb-2">Fecha de nacimiento <br><span class="text-blanco">{{$datos['birthday']}}</span></div>
                            <div class="col-6 mb-2">Lugar de nacimiento <br><span class="text-blanco">{{$datos['place_of_birth']}}</span></div>
                        </div>
                        <div class="row text-yellow">
                            <span class="text-[25px] mb-2">Redes Sociales</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    Sus Obras
                </div>
            </div>
        </div>
    @else
        <div class="imagen flex justify-center align-items-center w-100 bg-cover bg-no-repeat"
             style="background-image:linear-gradient(rgb(1,43,41,0.4),rgb(1,43,41,0.4)),
        url('https://image.tmdb.org/t/p/original/{{$datos['backdrop_path']}}'); background-position-y: 30%; height: 350px;">
        </div>
        <div class="bg-green pb-5 flex flex-col"
             style="height: calc(100% - 643px); padding-left: 15%; min-height: calc(100vh - 643px); min-width: 50%">
            <div class="container">
                <div class="row titulo flex flex-col justify-center rounded-[15px] pl-5">
                    <span class="text-yellow text-[18px]">{{$tipo ==='movie' ? 'Película' : 'Serie'}}</span>
                    <span class="text-blanco text-[20px]">{{$datos[$image_name]}}</span>
                </div>
                <div class="row">
                    <div class="col poster flex flex-col">
                        <img src="https://image.tmdb.org/t/p/w400/{{ $datos['poster_path'] }}"
                             class="rounded-t-[10px] w-[350px] h-[500px]">
                        <div class="acciones bg-green2 text-yellow rounded-b-[10px] w-[350px] h-[80px]">
                            <div class="row h-[80px]">
                                <div class="col flex flex-col align-items-center justify-center">
                                    <form method="POST" action="{{route('guardarContenido')}}">
                                        @csrf
                                        <input type="hidden" name="contenido" value="{{$tipo}}/{{$datos['id']}}/{{$datos[$image_name]}}">
                                        <button type="submit" class="flex flex-col justify-center align-items-center">
                                            <img class="w-[25px]" src="{{asset('images/watchlist/guardar.png')}}" alt="Guardar">
                                            Watchlist</button>
                                    </form>
                                </div>
                                <div class="col flex flex-col align-items-center justify-center">
                                    <button type="submit" class="flex flex-col justify-center align-items-center">
                                        <img class="w-[40px]" src="{{asset('images/logo_rolloAmarillo.png')}}" alt="Guardar">
                                        Valorar</button>
                                </div>
                                <div class="col flex flex-col align-items-center justify-center">
                                    <button type="submit" class="flex flex-col justify-center align-items-center" data-bs-toggle="modal" data-bs-target="#ComentarModal">
                                        <img class="w-[25px]" src="{{asset('images/comentario.png')}}" alt="Guardar">
                                        Comentar</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="ComentarModal" style="color:#ecb42d;" tabindex="-1" aria-labelledby="ComentarModallLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content" style="background-color:#1f4442;color:#ecb42d;">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="ComentarModalLabel">{{$datos[$image_name]}}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                @auth()
                                                <form method="POST" action="{{route('guardar.comentario')}}">
                                                    @csrf
                                                <div class="modal-body">
                                                        <div class="mb-3">
                                                            <input type="hidden" name="contenido" value="{{$tipo}}/{{$datos['id']}}/{{$datos[$image_name]}}">
                                                            <label for="message-text" class="col-form-label">Message:</label>
                                                            <textarea class="form-control mb-1" rows="3" name="comentario" maxlength="130" id="comentario"></textarea>
                                                            <span>130 caracteres</span>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn" style="background-color:#B62E2E;color:white" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn" style="background-color:#012B29;color:white">Send message</button>
                                                </div>
                                                </form>
                                                @else
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="message-text" class="col-form-label">Para comentar debes tener una cuenta.</label>
                                                            <a class="bg-green2 mt-2 p-3 text-[20px] no-underline text-blanco rounded-[10px]" href="/sign_up">Inicia
                                                                Sesión</a>
                                                        </div>
                                                    </div>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sinopsis mt-4 text-center text-blanco w-[350px]">
                            @if($datos['tagline']!="")
                                <span class="font-bold">{{$datos['tagline']}}</span> <br><br>
                            @endif
                            <p class="text-left">{{$datos['overview']}}</p>

                        </div>
                    </div>
                    <div class="col text-yellow">
                        <span class="text-[26px] mb-1">Ver Ahora</span>
                        <div class="plataformas bg-green2 flex p-4 rounded-[10px] w-[500px] h-[90px]"
                             style="border:1px solid #ecb42d; box-shadow:0px 4px 4px #1f4442;">
                            @if($plataformas == 'false')
                                <div class="flex flex-col justify-center align-items-center h-100">
                                    No hay plataformas disponibles.
                                </div>
                            @else
                                @foreach($plataformas as $plataforma)
                                    <div class=" flex flex-col justify-center align-items-center p-3">
                                        <img class="h-14 w-14 rounded-[15px]"
                                             src="https://image.tmdb.org/t/p/w400/{{ $plataforma['logo_path']}}"
                                             alt="Perfil">
                                        <span class="tetxt-center">{{ $plataforma['provider_name']}}</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="grid mt-5 grid-cols-12 text-[22px] gap-4">
                            <div class="col-span-6 mb-3">Tipo <br><span
                                    class="mt-1 text-blanco">{{$tipo ==='movie' ? 'Película' : 'Serie'}}</span></div>
                            <div class="col-span-6 mb-3">Calificacion<br><span
                                    class="mt-1 text-blanco">{{$tipo ==='movie' ? 'Película' : 'Serie'}}</span></div>
                            @if($tipo ==='movie')
                                <div class="col-span-6 mb-3">Duracion<br><span class="mt-1 text-blanco">{{$datos['runtime']}} minutos</span>
                                </div>
                            @else
                                <div class="col-span-6 mb-3">Temporadas<br><span
                                        class="mt-1 text-blanco">{{count($datos['seasons'])}}</span></div>

                            @endif
                            @if($certificacion!="false")
                                <div class="col-span-6 mb-3">Edad<br><span
                                        class="mt-1 text-blanco">+{{$certificacion}}</span></div>
                            @endif
                            @if(count($jefe)>0)
                                <div class="col-span-6 mb-3">{{$jefe[0]}}<br><span
                                        class="mt-1 text-blanco">{{$jefe[1]}}</span></div>
                            @endif
                            <div class="col-span-6 mb-3">Fecha<br><span
                                    class="mt-1 text-blanco">{{$tipo ==='movie' ? $datos['release_date'] : 'Serie'}}</span>
                            </div>
                            <div class="col-span-12 mb-3">Generos<br><span
                                    class="mt-1 text-blanco">{{implode(', ',array_column($datos['genres'],'name'))}}</span>
                            </div>
                            <div class="col-span-12 mb-3">Cast<br>
                                <div class="row">
                                    @foreach($cast as $index => $person)
                                        @if($index<4)
                                            <div class="col">
                                                @php($slug = Str::slug($person['name']))
                                                <form method="POST" action="{{route('person',['slug' => $slug])}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$person['id']}}">
                                                    <button type="submit">
                                                        <span class="mt-1 text-blanco">{{ $person['name']}}</span>
                                                    </button>
                                                </form>
                                                <span class="mt-1 text-blanco">{{ $person['character']}}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                            </div>
                            <div class="col-span-12 mb-3">Trailer<br><span
                                    class="mt-1 text-blanco">{{$tipo ==='movie' ? 'Película' : 'Serie'}}</span></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        $('.read-more').click(function() {
            $('.extra-content').removeClass('hidden');
            $('.read-more').addClass('hidden');
            $('.read-less').removeClass('hidden');
        });

        $('.read-less').click(function() {
            $('.extra-content').addClass('hidden');
            $('.read-more').removeClass('hidden');
            $('.read-less').addClass('hidden');
        });

    </script>

@endsection
