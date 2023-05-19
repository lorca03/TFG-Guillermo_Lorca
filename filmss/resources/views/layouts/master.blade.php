<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--Tailwind-->
    @vite('resources/css/app.css')
    <!--Boostrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!--Sytle-->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FILMSS - @yield('title')</title>
</head>
<body class="font-sans">
@if(!Str::contains($_SERVER["REQUEST_URI"],['/login','/sign_up']))
    @include("layouts.nav")
@endif

@yield('contenido','No hay nada')

@if(!Str::contains($_SERVER["REQUEST_URI"],['/login','/sign_up','/juegos','/perfil','/buscar','/person']))
    @include("layouts.footer")
@endif


<!--Scripts-->
@vite('resources/js/footer.js')

</body>
</html>
