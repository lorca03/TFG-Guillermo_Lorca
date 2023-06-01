<style>
    #form {
        width: 250px;
        margin: 0 auto;
        height: 50px;
    }

    #form p {
        text-align: center;
    }

    #form label {
        font-size: 20px;
    }

    input[type="radio"] {
        display: none;
    }

    label {
        color: white;
    }

    .clasificacion {
        direction: rtl;
        unicode-bidi: bidi-override;
    }

    label:hover,
    label:hover ~ label {
        color: #ecb42d;
    }

    input[type="radio"]:checked ~ label {
        color: #ecb42d;
    }
    .iniciarSesion:hover{
        box-shadow: 0px 4px 4px #012b29;
    }
</style>
<div class="modal fade" id="ValorarModal{{$datos['id']}}" style="color:#ecb42d;" tabindex="-1" aria-labelledby="ValorarModallLabel{{$datos['id']}}"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="background-color:#1f4442;color:#ecb42d;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ValorarModallLabel{{$datos['id']}}">{{$datos[$image_name]}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @auth()
                @if(count(\App\Models\Valoracion::valorada((isset($tipo)?$tipo:$datos[0]).'/'.$datos['id'].'/'.$datos[$image_name]))>0)
                    <div class="modal-body">
                        <div class="mt-2 flex align-items-center justify-center">
                            <span>Ya has valorado este contenido</span>
                        </div>
                    </div>
                @else
                    <form method="POST" action="{{route('valorar.contenido')}}">
                        @csrf
                        <div class="modal-body">
                            <div class="mt-2 flex align-items-center justify-center">
                                <input type="hidden" name="contenido" value="{{isset($tipo)?$tipo:$datos[0]}}/{{$datos['id']}}/{{$datos[$image_name]}}">
                                <p class="clasificacion">
                                    <input id="radio1{{$datos['id']}}" type="radio" name="estrellas{{$datos['id']}}" value="5">
                                    <label for="radio1{{$datos['id']}}">★</label>
                                    <input id="radio2{{$datos['id']}}" type="radio" name="estrellas{{$datos['id']}}" value="4">
                                    <label for="radio2{{$datos['id']}}">★</label>
                                    <input id="radio3{{$datos['id']}}" type="radio" name="estrellas{{$datos['id']}}" value="3">
                                    <label for="radio3{{$datos['id']}}">★</label>
                                    <input id="radio4{{$datos['id']}}" type="radio" name="estrellas{{$datos['id']}}" value="2">
                                    <label for="radio4{{$datos['id']}}">★</label>
                                    <input id="radio5{{$datos['id']}}" type="radio" name="estrellas{{$datos['id']}}" value="1">
                                    <label for="radio5{{$datos['id']}}">★</label>
                                </p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" style="background-color:#B62E2E;color:white"
                                    data-bs-dismiss="modal">Cancel
                            </button>
                            <button type="submit" class="btn" style="background-color:#012B29;color:white">Valorar</button>
                        </div>
                    </form>
                @endif
            @else
                <div class="modal-body">
                    <div class="mb-3  mt-3">
                        <sapn for="message-text" class="col-form-label">Para valorar debes tener una cuenta.</sapn>
                        <a class="iniciarSesion mt-2 p-3 text-[20px] no-underline text-blanco bg-yellow rounded-[10px]"
                           href="/sign_up">Regístrate</a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>
