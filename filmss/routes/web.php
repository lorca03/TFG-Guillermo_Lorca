<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ContenidoController;
use App\Http\Controllers\ImagenAleatoriaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValoracionController;
use App\Http\Controllers\WatchlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [UserController::class,'perfil'])->name('perfil');
    Route::post('/guardarContenido',[WatchlistController::class,'guardarContenido'])->name('guardarContenido');
    Route::post('/quitarContenido',[WatchlistController::class,'quitarContenido'])->name('quitarContenido');
    Route::post('/sendFriend', [UserController::class,'enviar'])->name('enviar');
    Route::post('/cancel_friend', [UserController::class,'cancel'])->name('cancelar.amistad');
    Route::post('/acept_friend', [UserController::class,'aceptar'])->name('aceptar.amistad');
    Route::post('/denegar_friend', [UserController::class,'denegar'])->name('denegar.amistad');
    Route::post('/actualizar', [UserController::class,'update'])->name('actualizar.datos');
    Route::post('/guardarComentario', [ComentarioController::class,'guardar'])->name('guardar.comentario');
    Route::post('/valorar', [ValoracionController::class,'valorar'])->name('valorar.contenido');
    Route::post('/vista', [WatchlistController::class,'vista'])->name('vista');
});

Route::get('/',  [ApiController::class,'home'])->name('/');
Route::get('/filter', [ApiController::class, 'filter'])->name('filter');
Route::post('/pelicula/{slug}',  [ContenidoController::class,'contenido'])->name('movie');
Route::post('/serie/{slug}',  [ContenidoController::class,'contenido'])->name('tv');
Route::post('/person/{slug}',  [ContenidoController::class,'contenido'])->name('person');
Route::get('/tendencias', [ApiController::class,'tendencias']);
Route::get('/watchlist',[WatchlistController::class,'index'])->name('watchlist');
Route::get('/login', function () { return view('pages.login');})->name('login');
Route::get('/sign_up', function () { return view('pages.sign_up');});
Route::get('/juegos', function () { return view('pages.juegos');});

Route::get('/obtenerMasResultados',  [ApiController::class,'obtenerMasResultados'])->name('obtenerMasResultados');
Route::get('/buscar', [ApiController::class,'search'])->name('explorar.home');
Route::post('/validar-registro',[UserController::class,'register'])->name('registro');
Route::post('/iniciar-sesion', [UserController::class,'login'])->name('inicio.sesion');
Route::get('/logout',[UserController::class,'logout'])->name('logout');


