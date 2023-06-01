<style>
    .iniciarSesion:hover{
        box-shadow: 0px 4px 4px #012b29;
    }
    .genre-button.selected {
        color: #ecb42d;
    }
</style>
<div class="modal fade" id="GeneroModal" style="color:#ecb42d;" tabindex="-1" aria-labelledby="GeneroModallLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="background-color:#012b29;color:white;border:1px solid white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="GeneroModalLabel">Género</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @auth()
                <form action="{{route('/')}}" method="GET" id="form">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="container text-[14px]">
                            <div class="row mb-3 ">
                                @php
                                $generos = \App\Http\Controllers\ApiController::generos();
                                @endphp
                            @foreach($generos as $key => $genero)
                                    @if($loop->iteration % 3 == 1 && $loop->iteration != 1)
                            </div><div class="row mb-3">
                                @endif
                                <div class="col-4 flex justify-center align-items-center">
                                        <button type="button" data-value="{{$genero}}" style="width:150px;font-size:15px"
                                        class="genre-button no-underline gap-2 flex justify-start align-items-center text-blanco p-2 bg-green2 rounded-[15px]">
                                            <img class="w-[25px]" src="{{asset('images/watchlist/checkVerde.png')}}" alt="Icono">{{$genero}}</button>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" style="background-color:#B62E2E;color:white" data-bs-dismiss="modal">Cancel</button>
                    <input type="hidden" name="genero" id="genero-input">
                    <button type="submit" class="btn" style="background-color:#1f4442;color:white">Aplicar Filtros</button>
                </div>
                </form>
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
<script>
    const genreButtons = document.querySelectorAll('.genre-button');
    const generoInput = document.getElementById('genero-input');
    const urlParams = new URLSearchParams(window.location.search);
    const generosSeleccionados = urlParams.get('genero');

    if (generosSeleccionados) {
        const generosArray = generosSeleccionados.split(',');
        generosArray.forEach(genero => {
            const button = document.querySelector(`.genre-button[data-value="${genero}"]`);
            if (button) {
                button.classList.add('selected');
            }
        });

    }else{

    }
    genreButtons.forEach(button => {
        button.addEventListener('click', () => {
            button.classList.toggle('selected');
            const selectedGenres = Array.from(document.querySelectorAll('.genre-button.selected')).map(button => button.dataset.value);
            generoInput.value = selectedGenres.join(',');

        });
    });
</script>




