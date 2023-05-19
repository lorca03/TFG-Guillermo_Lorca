@extends('layouts.master')
@section('title')
    BUSQUEDA
@endsection
@section('contenido')

    <div class="contenedor_busqueda bg-green2 w-100"
         style="height: calc(100% - 131px); min-height: calc(100vh - 131px);">
        <div class="container text-blanco flex justify-center pt-14">
            <ul class="l_homeF flex justify-between text-[30px]">
                @php
                    $pos = strpos($_SERVER['REQUEST_URI'], '&');
                    $uri = $pos !== false ? substr($_SERVER['REQUEST_URI'], 0, $pos) : $_SERVER['REQUEST_URI'];
                @endphp
                <li><a class="enlaces_Home no-underline text-blanco hover:text-yellow" href="{{$uri}}&filtrar=todo">Todo</a></li>
                <li><a class="enlaces_Home no-underline text-blanco hover:text-yellow " href="{{$uri}}&filtrar=peliculas">Películas</a></li>
                <li><a class="enlaces_Home no-underline text-blanco hover:text-yellow" href="{{$uri}}&filtrar=series">Series</a></li>
                <li><a class="enlaces_Home no-underline text-blanco hover:text-yellow" href="{{$uri}}&filtrar=personas">Personas</a></li>
            </ul>
        </div>
        <div class="container mt-[50px] text-blanco">
            <div class="row flex align-items-center pb-4 justify-center">
                @if(isset($resultado))
                    @foreach($resultado as $result)
                        <div class="col-sm-6 col-md-4 col-lg-2 flex-col flex align-items-center">
                            @php
                                $image_path = isset($result['poster_path']) ? $result['poster_path'] :
                                              (isset($result['profile_path']) ? $result['profile_path'] :
                                              (isset($result['backdrop_path']) ? $result['backdrop_path'] : false));
                                $image_name = isset($result['title']) ? 'title' : 'name';
                                $slug = Str::slug($result[$image_name]);
                            @endphp
                            @if($slug!=null)
                            <form method="POST" action="{{route( $filtrar==false?($result['media_type']):$filtrar,['slug' => $slug])}}" >
                                @csrf
                                <input type="hidden" name="id" value="{{$result['id']}}">
                                <button type="submit"
                                        class="flex flex-col align-items-center justify-content-start h-[321px] no-underline text-blanco hover:text-yellow">
                                @if($image_path)
                                    <img src="https://image.tmdb.org/t/p/w400/{{ $image_path }}"
                                         class="rounded-[10px] w-[166px] h-[249px]" style="box-shadow:0px 4px 4px #012b29">
                                @else
                                    <div class="bg-gray-300 w-[166px] h-[249px] rounded-[10px]"><img src="{{asset('images/no-image-slide.png')}}" class="w-[166px] h-[249px] rounded-[10px]"></div>
                                @endif
                                <span class="text-center mt-2">{{$result[$image_name]}}</span>
                                </button>
                            </form>
                        </div>
                        @if($loop->iteration % 6 == 0)
                            </div>
                            <div class="row flex align-items-center pb-4 justify-center">
                         @endif
                    @endif
                @endforeach
                @endif
            </div>
        </div>
    </div>

@endsection
