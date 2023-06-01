<style>
    .iniciarSesion:hover{
        box-shadow: 0px 4px 4px #012b29;
    }
</style>
<div class="modal fade" id="PaisModal" style="color:#ecb42d;" tabindex="-1" aria-labelledby="PaisModallLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="background-color:#012b29;color:white;border:1px solid white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="PaisModalLabel">Paises</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @auth()
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="container text-[14px]">
                            <div class="row mb-3 ">
                                @php
                                    $paises = \App\Http\Controllers\ApiController::paises();
                                @endphp
                                @foreach($paises as $key => $pais)
                                    @if($loop->iteration % 3 == 1 && $loop->iteration != 1)
                            </div><div class="row mb-3">
                                @endif
                                <div class="col-4 flex justify-center align-items-center">
                                    <button href="" class="no-underline gap-2 flex justify-start align-items-center text-blanco p-2 bg-green2 rounded-[15px]"
                                            style="width:150px;font-size:15px">
                                        <img class="w-[25px]" src="{{asset('images/watchlist/checkVerde.png')}}" alt="Icono">{{$pais}}</button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="modal-body">
                    <div class="mb-3  mt-3">
                        <sapn for="message-text" class="col-form-label">Para ver los comentarios debes tener una cuenta.</sapn>
                        <a class="iniciarSesion mt-2 p-3 text-[20px] no-underline text-blanco bg-yellow rounded-[10px]"
                           href="/sign_up">Regístrate</a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>
