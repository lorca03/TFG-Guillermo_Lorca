@extends('layouts.master')
@section('title')
    HOME
@endsection
@section('contenido')

    <div
        class="contenedor_buscador flex justify-center align-items-center w-100 h-80 min-h-min bg-cover bg-no-repeat"
        style="background-image:linear-gradient(rgb(236,180,45,0.6),rgb(236,180,45,0.6)),url('https://image.tmdb.org/t/p/original/{{$imagen_aleatoria}}'); background-position-y: 20%;">

        <div class="container text-green text-5xl font-bold">
            Bienvenido a FILMSS <br>
            <p class="text-3xl font-normal [text-shadow:_0_3px_4px_rgb(1_43_41_/_40%)]">Descubre nuevas películas,
                series y personas. Explora y disfruta.</p>
            <form action="{{ route('explorar.home') }}" method="GET">
                <div class="buscador relative inline-flex mt-8 w-100 text-xl font-normal">
                    <input type="text" id="inputBuscador" name="s"
                           class="bg-green2 font- rounded-[50px] text-blanco p-[35px] h-10 w-full placeholder-white"
                           placeholder="Buscar peliculas, programas de televisión, personas...">
                    <button type="submit"
                            class="absolute rounded-[50px] right-0 p-[35px] h-10 top-0 bg-yellow hover:text-white flex items-center">
                        Explora
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="contenedor_busqueda bg-green w-100"
         style="height: calc(100% - 243px); min-height: calc(100vh - 243px);">
        <div class="container text-yellow flex justify-center pt-20">
            <ul class="l_homeF flex justify-between text-[30px]">
                @php
                        $pos = strpos($_SERVER['REQUEST_URI'], 'filtrar');
                        $uri = $pos !== false ? (substr($_SERVER['REQUEST_URI'],$pos-1,1)=='?'?substr($_SERVER['REQUEST_URI'],0,$pos-1).'?':substr($_SERVER['REQUEST_URI'],0,$pos-1).'&')
                        : ($_SERVER['REQUEST_URI']=='/'?$_SERVER['REQUEST_URI'].'?':$_SERVER['REQUEST_URI'].'&');
                    @endphp
                <li><a class="enlaces_Home no-underline text-yellow hover:text-blanco" href="{{$uri}}filtrar=todo">Todo</a></li>
                <li><a class="enlaces_Home no-underline text-yellow hover:text-blanco " href="{{$uri}}filtrar=peliculas">Películas</a></li>
                <li><a class="enlaces_Home no-underline text-yellow hover:text-blanco" href="{{$uri}}filtrar=series">Series</a></li>
            </ul>
        </div>
        <div class="container text-blanco flex justify-center gap-[80px] pt-8">
            <button type="submit" class="filtroModal" data-bs-toggle="modal" data-bs-target="#GeneroModal" data-genre="">Género</button>
                @include('pages.modales.home.generoModal')
            <button type="submit" class="filtroModal" data-bs-toggle="modal" data-bs-target="#PuntuacionModal">Puntuación</button>
                @include('pages.modales.home.puntuacionModal')
            <button type="submit" class="filtroModal">Idioma</button>
            <button type="submit" class="filtroModal">Duración</button>
            <button type="submit" class="filtroModal" data-bs-toggle="modal" data-bs-target="#PaisModal">País</button>
                @include('pages.modales.home.PaisModal')
        </div>
        <div class="container-fluid flex justify-center gap-[10px] pt-14">
            @php
                $pos = strpos($_SERVER['REQUEST_URI'], 'plataforma');
                $uri = $pos !== false ? (substr($_SERVER['REQUEST_URI'],$pos-1,1)=='?'?substr($_SERVER['REQUEST_URI'],0,$pos-1).'?':substr($_SERVER['REQUEST_URI'],0,$pos-1).'&')
                : ($_SERVER['REQUEST_URI']=='/'?$_SERVER['REQUEST_URI'].'?':$_SERVER['REQUEST_URI'].'&');
            @endphp
            @foreach($aplicaciones as $aplicacion)
            <div class="rounded-[15px]">
                <a href="{{$uri}}plataforma={{$aplicacion['provider_id']}}" class="">
                    <img class="h-14 w-14 rounded-[15px]" src="https://image.tmdb.org/t/p/w400/{{$aplicacion['logo_path']}}" alt="Perfil">
                </a>
            </div>
            @endforeach
            @php $contador = 0 @endphp
        </div>
        <div class="container mt-[50px] text-blanco" id="resultados">
            <div class="row flex align-items-center pb-4 justify-center">
                @if(isset($resultado))
                    @foreach($resultado as $key => $result)
                        <div class="col-sm-6 col-md-4 col-lg-2 flex-col flex align-items-center">
                            @php
                                $image_path = isset($result['poster_path']) ? $result['poster_path'] :
                                              (isset($result['profile_path']) ? $result['profile_path'] :
                                              (isset($result['backdrop_path']) ? $result['backdrop_path'] : false));
                                $image_name = isset($result['title']) ? 'title' : 'name';
                                $contador++;
                                $slug = Str::slug($result[$image_name]);
                            @endphp
                            <form method="POST" action="{{route($result['media_type'],['slug' => $slug])}}" >
                                @csrf
                                <input type="hidden" name="id" value="{{$result['id']}}">
                                <button type="submit"
                                        class="flex flex-col align-items-center justify-content-start h-[321px] no-underline text-blanco hover:text-yellow">
                                    @if($image_path)
                                        <img src="https://image.tmdb.org/t/p/w400/{{ $image_path }}"
                                             class="rounded-[10px] w-[166px] h-[249px]"
                                             style="box-shadow:0px 4px 4px #012b29">
                                    @else
                                        <div class="bg-gray-300 w-[166px] h-[249px] rounded-[10px]"><img
                                                src="{{asset('images/no-image-slide.png')}}"
                                                class="w-[166px] h-[249px] rounded-[10px]"></div>
                                    @endif
                                    <span class="text-center mt-2">{{$result[$image_name]}}</span>
                                </button>
                            </form>
                        </div>
                        @if($contador % 6 == 0)
            </div>
                            <div class="row flex align-items-center pb-4 justify-center" id="resultados">

                @endif
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <script>
        @if(strpos($_SERVER['REQUEST_URI'], 'filtrar')!==false)
            var filtro = urlParams.get("filtrar");
            console.log(filtro);
        @else
             filtro=''
        @endif
       @if(strpos($_SERVER['REQUEST_URI'], 'genero')!==false)
            var genero = urlParams.get("genero");
            console.log(genero);
       @else
            genero=''
       @endif
        @if(strpos($_SERVER['REQUEST_URI'], 'plataforma')!==false)
            var plataforma = urlParams.get("plataforma");
            console.log(plataforma);
        @else
            genero=''
        @endif

        var contador = 4;
        var ocupan2 = ['Ciencia ficción', 'Terror', 'Acción', 'Aventura', 'Fantasía'];
        var generoSeparado = genero.split(',');

        if (filtro == 'todo' || filtro == '') {
            contador = 4;
        } else if (generoSeparado.some(elemento => ocupan2.includes(elemento))) {
            contador = 2;
            console.log(genero);
        } else if (genero == 'Historia') {
            contador = -1;
        } else {
            contador = 2;
        }

        function crearHTMLResultados(resultados) {
            let html = '';
            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            for (let i = 0; i < resultados.length; i++) {
                const result = resultados[i];
                let image_path = result['poster_path'] ?? result['profile_path'] ?? result['backdrop_path'] ?? false;
                let image_name = result['title'] ? 'title' : 'name';
                let route = ''
                switch (result['media_type']) {
                    case 'movie':
                        route = '{{ route("movie", ["slug" => ":slug"]) }}';
                        break;
                    case 'tv':
                        route = '{{ route("tv", ["slug" => ":slug"]) }}';
                        break;
                    case 'person':
                        route = '{{ route("person", ["slug" => ":slug"]) }}';
                        break;
                }
                route = route.replace(':slug', result[image_name]);
                html += '<div class="col-sm-6 col-md-4 col-lg-2 flex-col flex align-items-center">';
                html += '<form method="POST"  action="'+route+'">';
                html += '<input type="hidden" name="_token" value="' + csrfToken + '">'; /*action="'+route+'"*/
                html += '<input type="hidden" name="id" value="'+result['id']+'">';
                html += '<button type="submit" class="flex flex-col align-items-center justify-content-start h-[321px] no-underline text-blanco hover:text-yellow">'
                if(image_path) {
                    html += '<img src="https://image.tmdb.org/t/p/w400/'+image_path+'"'
                    html += 'class="rounded-[10px] w-[166px] h-[249px]" style="box-shadow:0px 4px 4px #012b29">'
                } else {
                    html += '<div class="bg-gray-300 w-[166px] h-[249px] rounded-[10px]"><img '
                    html += 'src="{{asset('images/no-image-slide.png')}}" class="w-[166px] h-[249px] rounded-[10px]"></div>'
                }
                html += '<span class="text-center mt-2">' + result[image_name] + '</span>';
                html += '</button></form></div>';
                contador++;
                if (contador % 6 == 0) {
                    html += '</div><div class="row flex align-items-center pb-4 justify-center" id="resultados">';
                    contador=0;
                }
            }
            return html;
        }

        var pagina = 1;
        var cargando = false;
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 1000 && !cargando) {
                pagina++;
                cargando = true;
                $.ajax({
                    url: '{{ route("obtenerMasResultados") }}',
                    type: 'GET',
                    data: {
                        pagina: pagina,
                        @if(strpos($_SERVER['REQUEST_URI'], 'filtrar')!==false)
                            filtrar: filtro,
                        @endif
                        @if(strpos($_SERVER['REQUEST_URI'], 'genero')!==false)
                            genero:genero,
                        @endif
                        @if(strpos($_SERVER['REQUEST_URI'], 'plataforma')!==false)
                            plataforma: plataforma
                        @endif
                    },
                    success: function (response) {
                        const nuevosHTML = crearHTMLResultados(response);
                        $('div[id="resultados"]:last').append(nuevosHTML);
                    },
                    complete: function () {
                        cargando = false;
                    }
                });
            }
        });
    </script>

@endsection
