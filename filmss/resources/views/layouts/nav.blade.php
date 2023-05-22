<nav class="navbar bg-green">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset("images/LOGO_TRANSPARENTE.png") }}" alt="FILMSS" width="105" height="80">
        </a>
        <ul class="flex justify-between items-center h-full list-none p-0 m-0 ">
            <li class="mx-6"><a href="/tendencias" class="<?php echo App\Utils\Activa::comprobarActiva('tendencias')?'active':'' ;?>
                text-base no-underline font-medium text-blanco hover:text-yellow focus:text-yellow text-xl">Tendencias</a></li>
            <li class="mx-6"><a href="/watchlist" class="<?php echo App\Utils\Activa::comprobarActiva('watchlist')?'active':'' ;?>
                text-base no-underline font-medium text-blanco hover:text-yellow focus:text-yellow text-xl">Watchlist</a></li>
            <li class="mx-6"><a href="/juegos" class="<?php echo App\Utils\Activa::comprobarActiva('juegos')?'active':'' ;?>
                text-base no-underline font-medium text-blanco hover:text-yellow focus:text-yellow text-xl">Juegos</a></li>
            <li class="mx-6"><a href="/perfil?seccion=cuenta" class="<?php echo App\Utils\Activa::comprobarActiva('perfil')?'active':'' ;?>
                "><img class="h-8 w-auto" src="{{ asset("images/iconoLogin2.png") }}" alt="Perfil"></a></li>
        </ul>
    </div>
</nav>
