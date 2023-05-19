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
                           placeholder="&#xf002; Buscar peliculas, programas de televisión, personas...">
                    {{--                <img src="{{ asset("images/lupa-blanca.png") }}" class="absolute h-6 left-7 top-6"  alt="lupa">--}}
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
        <div class="container text-blanco flex justify-center pt-20">
            <ul class="l_homeF flex justify-between text-[30px]">
                <li><a class="enlaces_Home no-underline text-blanco hover:text-yellow" href="#">Todo</a></li>
                <li><a class="enlaces_Home no-underline text-blanco hover:text-yellow " href="#">Películas</a></li>
                <li><a class="enlaces_Home no-underline text-blanco hover:text-yellow" href="#">Series</a></li>
            </ul>
        </div>
        <div class="container text-green flex justify-center gap-[80px] pt-8">
            <button type="submit" class="filtroModal">Género</button>
            <button type="submit" class="filtroModal">Puntuación</button>
            <button type="submit" class="filtroModal">Idioma</button>
            <button type="submit" class="filtroModal">Duración</button>
            <button type="submit" class="filtroModal">País</button>
        </div>
        <div class="container-fluid flex justify-center gap-[10px] pt-14">
            <?php
            for ($i = 0;
                 $i < 20;
                 $i++){
                ?>
            <div class="rounded-[15px]"><a href="#" class=""><img class="h-14 w-14 rounded-[15px]"
                                                                  src="{{ asset("images/netflix.png") }}" alt="Perfil"></a>
            </div>
                <?php
            }
            $contador = 0
            ?>
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
        var contador = 4;
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
                    data: {pagina: pagina},
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
