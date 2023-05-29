@extends('layouts.master')
@section('title')
    PERFIL
@endsection
@section('contenido')
    <style>
        /*Dropdown*/
        .dropbtn {
            min-width: 160px;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #012b29;
            min-width: 160px;
            border: 1px solid #fff;
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
    <div class="bg-green2" style="height: calc(100% - 131px); min-height: calc(100vh - 131px);">
        <div class="container flex flex-col pt-20"><span class="text-yellow text-[45px]">¡Hola {{Auth::user()->name}}!</span>
            @if(isset($_GET['seccion']))
                <div class="mt-12 flex justify-center space-x-12 text-[27px]">
                    <a href="/perfil?seccion=cuenta" class="<?php echo $_GET['seccion']=='cuenta'?'activePerfil':'noActivePerfil' ;?>
                     hover:text-blanco px-3 py-2 no-underline">Cuenta</a>
                    <a href="/perfil?seccion=plataformas" class="<?php echo $_GET['seccion']=='plataformas'?'activePerfil':'noActivePerfil' ;?>
                    px-3 hover:text-blanco py-2 no-underline">Tus plataformas</a>
                    <div class="dropdown text-yellow">
                        <button
                            class="dropbtn px-3 py-2 <?php echo $_GET['seccion'] == 'amigos' ? 'activePerfil' : ($_GET['seccion'] == 'descubre' ? 'activePerfil' : 'noActivePerfil'); ?>">
                            Personas
                        </button>
                        <div class="dropdown-content text-center">
                            <a href="/perfil?seccion=amigos" class="<?php echo $_GET['seccion']=='amigos'?'text-blanco':'noActivePerfil' ;?>
                    hover:text-blanco no-underline">Amigos</a>
                            <a href="/perfil?seccion=descubre" class="<?php echo $_GET['seccion']=='descubre'?'text-blanco':'noActivePerfil' ;?>
                     hover:text-blanco no-underline">Descubre</a>
                        </div>
                    </div>
                </div>
                @switch($_GET['seccion'])
                    @case('cuenta')
                        <form action="{{route('actualizar.datos')}}" method="POST">
                            @csrf
                            <div class="container-fluid flex justify-center align-items-center">
                                <div class="flex mt-14 text-[22px] text-yellow flex-col w-1/2 space-y-9">
                                    <div class="flex justify-between align-items-center">
                                        <span style="text-shadow:0px 4px 4px #012b29;">Nombre</span>
                                        <input placeholder="{{Auth::user()->name}}" type="text" name="name"
                                               class="inputCuenta rounded-[10px] focus:outline-0 placeholder-blanco p-2 bg-transparent">
                                    </div>
                                    <div class="flex justify-between align-items-center">
                                        <span style="text-shadow:0px 4px 4px #012b29;">Correo Electrónico</span>
                                        <input placeholder="{{Auth::user()->email}}" type="email" name="email"
                                               class="inputCuenta rounded-[10px] focus:outline-0 placeholder-blanco p-2 bg-transparent">
                                    </div>
                                    <div class="flex justify-between align-items-center">
                                        <span style="text-shadow:0px 4px 4px #012b29;">Contraseña</span>
                                        <input placeholder="••••••••" type="password" name="password"
                                               class="inputCuenta rounded-[10px] focus:outline-0 placeholder-blanco p-2 bg-transparent">
                                    </div>
                                    <div class="flex align-items-center justify-between pt-5">
                                        <a href="{{route('logout')}}"
                                           class="w-1/4 text-yellow rounded-[15px] no-underline"
                                           style="min-width:155px;border:2px solid #ecb42d;box-shadow:0px 4px 4px #012b29;">
                                            <div
                                                class="flex flex-col text-[20px] align-items-center justify-center pt-2 pb-2">
                                                <img src="{{asset('images/logoutAmarillo.png')}}"
                                                     class="w-[40px] h-[40px]" alt="">Cerrar Sesión
                                            </div>
                                        </a>
                                        <button type="submit"
                                                class="bg-blanco text-green w-1/3 p-2 text-[28px] rounded-[10px]"
                                                style="box-shadow:0px 4px 4px #012b29;text-shadow:0px 1px 4px #012b29;min-width:210px;">
                                            Actualizar
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>
                        @break
                    @case('plataformas')
                        <div class="container-fluid flex justify-center align-items-center">
                            <div class="flex mt-14 text-[22px] text-yellow flex-col w-1/2 space-y-9">
                                <div class="bg-green flex space-x-3 p-4 rounded-[15px]"
                                     style="border:1px solid #ecb42d;box-shadow:0px 4px 4px #012b29;">
                                        <?php
                                    for ($i = 0;
                                         $i < 2;
                                         $i++){
                                        ?>
                                    <div class="rounded-[15px]"><a href="#" class=""><img
                                                class="h-16 w-16 rounded-[15px]" src="{{ asset("images/netflix.png") }}"
                                                alt="Perfil"></a></div>
                                        <?php
                                    }
                                        ?>
                                </div>
                                <span class="text-blanco">Añade nuevas plataformas a tu perfil</span>
                                <div class="flex justify-center pb-4 align-items-center flex-col">
                                    <input type="search"
                                           class="placeholder-yellow focus:outline-0 w-10/12 p-3 bg-green rounded-[15px]"
                                           placeholder="Buscar nuevos servicios que añadir">
                                    <div
                                        class="bg-green w-10/12 mt-5 flex flex-col justify-center align-items-center p-4 rounded-[15px]"
                                        style="border:1px solid #ecb42d;box-shadow:0px 4px 4px #012b29;">
                                            <?php
                                        for ($i = 0;
                                             $i < 6;
                                             $i++){
                                            ?>
                                        <div
                                            class="bg-green2 flex justify-around flex-row align-items-center p-2 mb-2 w-10/12 rounded-[15px]">
                                            <div class="flex justify-center align-items-center">
                                                <div class="rounded-[15px]">
                                                    <img class="h-16 w-16 rounded-[15px]"
                                                         src="{{ asset("images/netflix.png") }}" alt="Perfil">
                                                </div>
                                                <span class="pl-2">Netflix</span>
                                            </div>
                                            <a href="">
                                                <div class="bg-green rounded-[30px] w-[35px] h-[35px]"></div>
                                            </a>
                                        </div>
                                            <?php
                                        }
                                            ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @break
                    @case('amigos')
                        <div class="container flex align-items-start mt-5 justify-center" style="gap:120px">
                            <div class="flex flex-col justify-center align-items-center gap-2">
                            @foreach($pending as $peticion)
                                @if($peticion->recipient_id === \Auth::id())
                                        <div class="flex justify-center align-items-center bg-green rounded-[15px] text-blanco"
                                             style="width:230px;height:110px;border:1px solid #fff;box-shadow:0px 4px 4px #012b29;">
                                            <div class="container">
                                                <div class="row pl-5">{{'@'.$users->find($peticion->sender_id)->name}}</div>
                                                <div class="row mt-3">
                                                    <div class="col flex justify-center align-items-center">
                                                        <form action="{{ route('aceptar.amistad') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" value="{{$peticion->sender_id}}" name="sender">
                                                        <button type="submit" class="bg-green2 p-2 rounded-[15px]">Aceptar</button></form>
                                                    </div>
                                                    <div class="col flex justify-center align-items-center">
                                                        <form action="{{ route('denegar.amistad') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" value="{{$peticion->sender_id}}" name="sender">
                                                        <button type="submit" class="p-2 rounded-[15px]"
                                                                style="background-color:#B62E2E">Eliminar
                                                        </button></form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                @endif
                                @if($peticion->sender_id === \Auth::user()->id)
                                        <div class="flex mb-4 justify-center align-items-center bg-green rounded-[15px] text-blanco"
                                             style="width:230px;height:110px;border:1px solid #fff;box-shadow:0px 4px 4px #012b29;">
                                            <div class="container">
                                                <div class="row pl-5">{{'@'.$users->find($peticion->recipient_id)->name}}</div>
                                                <div class="row mt-3">
                                                    <form  method="POST" action="{{ route('cancelar.amistad') }}">
                                                        @csrf
                                                        <input type="hidden" value="{{$peticion->recipient_id}}" name="recipient">
                                                        <input type="hidden" value="{{$peticion->sender_id}}" name="sender">
                                                        <button type="submit" class="p-2 rounded-[15px]" style="background-color:#B62E2E">
                                                            Cancelar amistad</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                @endif
                            @endforeach
                            </div>
                            <div class="bg-green w-[350px] inline-block flex flex-col justify-center align-items-center p-4 rounded-[15px]"
                                style="border:1px solid #ecb42d;box-shadow:0px 4px 4px #012b29;min-height: auto">
                                @if(count($friends)>0)
                                    @foreach($friends as $friend)
                                <div class="bg-green2 flex flex-col justify-center align-items-center pt-4 p-2 pb-3 mb-2 w-10/12 rounded-[15px]"
                                    style="gap: 15px">
                                    <div class="flex justify-center align-items-center" style="gap:45px;">
                                        <span class="text-[20px] text-yellow">{{'@'.$friend->name}}</span>
                                        <button type="button" class="btn rounded-[15px] p-2" data-bs-toggle="modal" data-bs-target="#watchlistModal"
                                                style="border:1px solid #fff;color:#fff;background-color:#ecb42d">
                                                Watchlist
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="watchlistModal" tabindex="-1" aria-labelledby="watchlistModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content" style="background-color:#ecb42d;color:#FFF; border:1px solid white">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="watchlistModalLabel">{{'@'.$friend->name}}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @php($watchlist= new \App\Models\Watchlist())
                                                        <ul>
                                                        @foreach($watchlist->registros($friend->id) as $contenido)
                                                                @php($parts = explode("/",$contenido->contenido))
                                                                <li>
                                                                    <form method="POST" action="{{route($parts[0],['slug' => Str::slug($parts[2])])}}">
                                                                        @csrf
                                                                        <input type="hidden" name="id" value="{{$parts[1]}}">
                                                                        <button type="submit" class="text-green">
                                                                            {{$parts[2]}}
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                        @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="">
                                        <span class="pl-2 text-blanco">{{$friend->email}}</span>
                                    </div>
                                </div>
                                    @endforeach
                                @else
                                    <h1 class="text-blanco">Sin amigos</h1>
                                @endif
                            </div>
                        </div>
                        @break
                    @case('descubre')
                        <div class="container-fluid flex justify-center align-items-center">
                            <div class="flex mt-14 text-[22px] text-yellow flex-col w-1/2 space-y-9">
                                <div class="flex justify-center pb-4 align-items-center flex-col">
                                    <form action="{{ route('perfil')}}" method="GET" class="flex gap-3">
                                        <input type="hidden" name="seccion" value="descubre">
                                        <input type="search" class="placeholder-yellow focus:outline-0 w-10/12 p-3 bg-green rounded-[15px]"
                                                   placeholder="Busca nuevos amigos" name="buscar">
                                        <button type="submit" class="bg-white text-yellow rounded-[15px] p-2">Buscar</button>
                                    </form>
                                    <div
                                        class="bg-green mt-5 flex flex-col justify-center align-items-center p-4 rounded-[15px]"
                                        style="border:1px solid #ecb42d;box-shadow:0px 4px 4px #012b29;width: 55%">
                                        @if(count($users)>0)
                                        @foreach($users as $usuario)
                                            @if($usuario->id!=Auth::id())
                                                <div
                                                    class="bg-green2 flex justify-around flex-row align-items-center p-2 mb-2 w-10/12 rounded-[15px]">
                                                    <div class="flex justify-center align-items-center">
                                                        <span class="pl-2">{{  '@'.$usuario->name }}</span>
                                                    </div>
                                                    @if($friends->find($usuario->id))
                                                        Amigo
                                                    @elseif($pending->where('recipient_id', $usuario->id)->count() > 0)
                                                        <span class="text-blanco text-[16px]">Pending...</span>
                                                    @else
                                                            <div class="bg-blanco rounded-[15px] text-yellow flex align-items-center justify-center text-[16px] w-16 h-14"
                                                                style="border:1px solid #ecb42d;box-shadow:0px 4px 4px #012b29">
                                                                <form method="POST" action="{{ route('enviar')}}" >
                                                                    @csrf
                                                                    <input type="hidden" value="{{$usuario->id}}" name="recipient">
                                                                    <button type="submit">
                                                                        Añadir
                                                                        <br>Amigo
                                                                    </button>
                                                                </form>
                                                            </div>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                        @else
                                            <h5>No se han encontrado usarios</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        @break
                @endswitch
            @else
                <div class="mt-12 flex justify-center text-blanco space-x-12 text-[27px]">
                    ¡¡¡No se ha definido la seccion!!!
                </div>
            @endif
        </div>
    </div>

@endsection
