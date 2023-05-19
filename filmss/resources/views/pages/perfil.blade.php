@extends('layouts.master')
@section('title')
    PERFIL
@endsection
@section('contenido')
    <div class="bg-green2" style="height: calc(100% - 131px); min-height: calc(100vh - 131px);">
        <div class="container flex flex-col pt-20"><span class="text-yellow text-[45px]">¡Hola Guillermo!</span>
            @if(isset($_GET['seccion']))
                <div class="mt-12 flex justify-center space-x-12 text-[27px]">
                    <a href="/perfil?seccion=cuenta" class="<?php echo $_GET['seccion']=='cuenta'?'activePerfil':'noActivePerfil' ;?>
                     hover:text-blanco px-3 py-2 no-underline">Cuenta</a>
                    <a href="/perfil?seccion=plataformas" class="<?php echo $_GET['seccion']=='plataformas'?'activePerfil':'noActivePerfil' ;?>
                    px-3 hover:text-blanco py-2 no-underline">Tus plataformas</a>
                    <a href="/perfil?seccion=amigos" class="<?php echo $_GET['seccion']=='amigos'?'activePerfil':'noActivePerfil' ;?>
                    px-3 py-2 hover:text-blanco no-underline">Amigos</a>
                </div>
                @switch($_GET['seccion'])
                    @case('cuenta')
                        <form action="">
                            @csrf
                            <div class="container-fluid flex justify-center align-items-center">
                                <div class="flex mt-14 text-[22px] text-yellow flex-col w-1/2 space-y-9">
                                    <div class="flex justify-between align-items-center">
                                        <span style="text-shadow:0px 4px 4px #012b29;">Nombre</span>
                                        <input placeholder="{{Auth::user()->name}}" type="text"
                                               class="inputCuenta rounded-[10px] focus:outline-0 placeholder-blanco p-2 bg-transparent">
                                    </div>
                                    <div class="flex justify-between align-items-center">
                                        <span style="text-shadow:0px 4px 4px #012b29;">Correo Electrónico</span>
                                        <input placeholder="{{Auth::user()->email}}" type="email"
                                               class="inputCuenta rounded-[10px] focus:outline-0 placeholder-blanco p-2 bg-transparent">
                                    </div>
                                    <div class="flex justify-between align-items-center">
                                        <span style="text-shadow:0px 4px 4px #012b29;">Contraseña</span>
                                        <input placeholder="••••••••" type="password"
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
                @endswitch
            @else
                <div class="mt-12 flex justify-center text-blanco space-x-12 text-[27px]">
                    ¡¡¡No se ha definido la seccion!!!
                </div>
            @endif
        </div>
    </div>

@endsection