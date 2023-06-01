<style>
    .iniciarSesion:hover{
box-shadow: 0px 4px 4px #012b29;
}
</style>
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
                    <div class="mb-3  mt-3">
                        <sapn for="message-text" class="col-form-label">Para comentar debes tener una cuenta.</sapn>
                        <a class="iniciarSesion mt-2 p-3 text-[20px] no-underline text-blanco bg-yellow rounded-[10px]"
                           href="/sign_up">Regístrate</a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>
