<?php

namespace App\Http\Controllers;

use App\Models\Watchlist;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WatchlistController extends Controller
{
    const SIN_ESTADO=0;
    const VISTA=1;
    const VALORADA=2;

    private $apiController;

    public function __construct()
    {
        $this->apiController = new ApiController();
    }

    /**
     * @param $mensaje
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index($mensaje=null)
    {
        if (Auth::check()){
            if (Auth::user()->registrosWatchlist()->exists()){
                if ($mensaje){
                    Session::flash('error', $mensaje);
                }
                $watchlist = new Watchlist();
                $registros = $watchlist->registros(Auth::id());
                $error = session('error');
                $responseData = array();
                foreach ($registros as $registro){
                    $position = strpos($registro->contenido, '/');
                    $tipo= substr($registro->contenido,0,$position);
                    $id = substr($registro->contenido,$position+1);
                    $apiUrl = 'https://api.themoviedb.org/3/' . $tipo . '/' . $id . '?language=es';
                    $responseData[$id] = $this->apiController->consulta($apiUrl);
                    array_push($responseData[$id],$tipo);
                }
                return view('pages.watchlist', compact('responseData', 'error'));
            }
        }
        return view('pages.watchlist');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function guardarContenido(Request $request)
    {
        try {
            $watchlist = new Watchlist();
            $watchlist->user_id = Auth::id();
            $watchlist->contenido = $request->input('contenido');
            $watchlist->estado = self::SIN_ESTADO;
            $watchlist->save();

            return $this->index();
        }catch (QueryException $e){
            $errorCode = $e->getCode();
            if ($errorCode == 23000) {
                // Guardar un mensaje de error específico para la duplicación de clave
                $mensaje='El elemento ya está en la watchlist.';
            } else {
                $mensaje='Se produjo un error al guardar el contenido.';
            }
            return redirect()->route('watchlist')->with('error', $mensaje);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function quitarContenido(Request $request)
    {
        try {
            Watchlist::where('user_id',Auth::id())
                    ->where('contenido',$request->input('contenido') )
                    ->delete();
            return redirect()->route('watchlist');
        }catch (QueryException $e){
            $errorCode = $e->getCode();
            $mensaje='Se produjo un error al eliminar el contenido.';
            return redirect()->route('watchlist')->with('error', $mensaje);
        }
    }

    /**
     * @param string $id
     * @return void
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
