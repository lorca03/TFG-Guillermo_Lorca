<style>
    .iniciarSesion:hover{
        box-shadow: 0px 4px 4px #012b29;
    }
</style>
<div class="modal fade" id="PuntuacionModal" style="color:#ecb42d;" tabindex="-1" aria-labelledby="PuntuacionModallLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="background-color:#012b29;color:white;border:1px solid white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="PuntuacionModalLabel">Puntuación</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @auth()
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="container mt-2 mb-2 text-[14px]">
                            <div class="row mb-3">
                                <div class="flex gap-2"><span>0</span>
                                    <input type="range" min="0" autocomplete="off" max="5" value="0" step="0.1" class="form-range" id="inputPuntuacion">
                                    <span>5</span></div>
                            </div>
                            <span id="valorInputPuntuacion">0</span>
                        </div>
                    </div>
                </div>
            @else
                <div class="modal-body">
                    <div class="mb-3  mt-3">
                        <span for="message-text" class="col-form-label">Para ver los comentarios debes tener una cuenta.</span>
                        <a class="iniciarSesion mt-2 p-3 text-[20px] no-underline text-blanco bg-yellow rounded-[10px]"
                           href="/sign_up">Regístrate</a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>
<script>
    var inputPuntuacion = document.getElementById("inputPuntuacion");

    var valorSpanPuntuacion = document.getElementById("valorInputPuntuacion");

    inputPuntuacion.addEventListener("input", function() {
        valorSpanPuntuacion.innerText = inputPuntuacion.value;
    });
</script>
