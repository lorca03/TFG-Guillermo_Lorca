<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ContenidoController;
use App\Http\Controllers\ImagenAleatoriaController;
use App\Http\Controllers\UserController;
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
    Route::get('/perfil', function () {
        return view('pages.perfil');
    })->name('perfil');
    Route::post('/guardarContenido',[WatchlistController::class,'guardarContenido'])->name('guardarContenido');
    Route::post('/quitarContenido',[WatchlistController::class,'quitarContenido'])->name('quitarContenido');
});

Route::get('/',  [ApiController::class,'home'])->name('/');
Route::post('/pelicula/{slug}',  [ContenidoController::class,'contenido'])->name('movie');
Route::post('/serie/{slug}',  [ContenidoController::class,'contenido'])->name('tv');
Route::post('/person/{slug}',  [ContenidoController::class,'contenido'])->name('person');
Route::get('/obtenerMasResultados',  [ApiController::class,'obtenerMasResultados'])->name('obtenerMasResultados');
Route::get('/buscar', [ApiController::class,'search'])->name('explorar.home');
Route::get('/tendencias', [ApiController::class,'tendencias']);
Route::get('/watchlist',[WatchlistController::class,'index'])->name('watchlist');
Route::get('/login', function () {
    return view('pages.login');
})->name('login');
Route::get('/sign_up', function () {
    return view('pages.sign_up');
});
Route::post('/validar-registro',[UserController::class,'register'])->name('registro');
Route::post('/iniciar-sesion', [UserController::class,'login'])->name('inicio.sesion');
Route::get('/logout',[UserController::class,'logout'])->name('logout');
Route::get('/juegos', function () {
    return view('pages.juegos');
});

