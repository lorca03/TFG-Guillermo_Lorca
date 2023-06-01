<?php

namespace App\Http\Controllers;

use App\Models\Valoracion;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValoracionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function valorar(Request $request)
    {
        $parts = explode("/",$request->input('contenido'));
        $tipo= $parts[0];
        $id = $parts[1];
        $valoracion = new Valoracion();
        $valoracion->user_id = Auth::id();
        $valoracion->contenido = $request->input('contenido');
        $valoracion->valoracion = $request->input('estrellas'.$id);
        $valoracion->save();
        WatchlistController::cambiarEstado(WatchlistController::VALORADA, $request->input('contenido'));
        return redirect(route('watchlist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
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
