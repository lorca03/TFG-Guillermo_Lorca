<style>
    .iniciarSesion:hover{
        box-shadow: 0px 4px 4px #012b29;
    }
</style>
<div class="modal fade" id="ComentariosModal" style="color:#ecb42d;" tabindex="-1" aria-labelledby="ComentariosModallLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="background-color:#1f4442;color:#ecb42d;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ComentarModalLabel">{{$datos[$image_name]}} - Comentarios</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @auth()
                    <div class="modal-body">
                        <div class="mb-3">
                            @foreach(\App\Models\Comentario::comentarios($tipo.'/'.$datos['id'].'/'.$datos[$image_name]) as $comentario)
                            <input type="hidden" name="contenido" value="{{$tipo}}/{{$datos['id']}}/{{$datos[$image_name]}}">
                            <div class="flex flex-col justify-center align-items-center">
                                <span>{{'@'.\App\Models\User::find($comentario->user_id)->name}}</span>
                                <span class="text-blanco">"{{$comentario->comentario}}"</span>
                            </div>
                                <hr>
                            @endforeach
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
