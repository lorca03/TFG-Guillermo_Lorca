<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ContenidoController extends Controller
{
    private $apiController;

    public function __construct()
    {
        $this->apiController = new ApiController();
    }

    public function contenido(Request $request)
    {
        $id = $request->input('id');
        $tipo = Route::currentRouteName();
        $apiUrl = 'https://api.themoviedb.org/3/' . $tipo . '/' . $id . '?language=es';
        $responseData = $this->apiController->consulta($apiUrl);
        $apiUrl = 'https://api.themoviedb.org/3/' . $tipo . '/' . $id . '/credits?language=es';
        $responseCredits = $this->apiController->consulta($apiUrl);
        if ($tipo!='person'){

            $apiUrl = 'https://api.themoviedb.org/3/' . $tipo . '/' . $id . '/watch/providers';
            $responsePlataforms = $this->apiController->consulta($apiUrl);
            $dates=$tipo=='movie'?'release_dates':'content_ratings';
            $apiUrl = 'https://api.themoviedb.org/3/' . $tipo . '/' . $id . '/'.$dates.'?language=es';
            $release = $this->apiController->consulta($apiUrl);
            foreach ($release['results'] as $persona) {
                if ($persona['iso_3166_1']=='ES'){
                    if ($tipo=='movie'){
                        $certificacion=$persona["release_dates"][0]["certification"];
                    }else{
                        $certificacion=$persona["rating"];
                    }
                }
            }
            $jefe=array();
            foreach ($responseCredits['crew'] as $persona) {
                if ($persona['job'] === "Director") {
                    $directores[] = $persona['name'];
                } elseif ($persona['job'] === "Executive Producer") {
                    $productores[] = $persona['name'];
                }
            }
            if (!empty($directores)) {
                $jefe = ['Directores' , implode(", ", array_slice($directores,0,2))];
            }elseif(!empty($productores)){
                $jefe = ['Productores',implode(", ", array_slice($productores,0,2))];
            }
            return view('pages.contenido',
                ['datos'=>$responseData ,
                    'tipo'=>$tipo,
                    'cast'=>$responseCredits['cast'],
                    'jefe'=>$jefe,
                    'plataformas'=>isset($responsePlataforms['results']['ES']['flatrate'])?$responsePlataforms['results']['ES']['flatrate']:'false',
                    'certificacion'=>$certificacion
                ]);
        }
//        var_dump($responseData);
        return view('pages.contenido',
            ['datos'=>$responseData ,
                'tipo'=>$tipo
            ]);
    }
}
