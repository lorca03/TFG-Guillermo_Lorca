<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagenAleatoriaController extends Controller
{
    public function tendencias()
    {
        $imagenes = array('images/tendenciasAmigos2.jpg', 'images/tendenciasCafe.jpg');
        $indice = mt_rand(0, count($imagenes) - 1);
        return view('/pages.tendencias', ['imagen_aleatoria' => $imagenes[$indice]]);
    }

    public static function home($cliente)
    {
        $imagenes = array();
        $genero = mt_rand(0, 1) == 0 ? 'tv' : 'movie';
        $pages = 1;
        $apiUrl = 'https://api.themoviedb.org/3/discover/' . $genero . '?include_adult=false&language=es&region=US&sort_by=popularity.desc&vote_average.gte=8&vote_count.gte=300&watch_region=US&page=';
        do {
            $response = $cliente->request('GET', $apiUrl . $pages, [
                'headers' => [
                    'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmZDRmNDE2NWI0N2YzNDkyZGNmMDE3MWJjMGZkYWQ4MyIsInN1YiI6IjY0NWJkNDc2NmFhOGUwMDBlNGJlMzU4NiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.yzENA_sZUyHmedM3zgZFWMMae4JvCzKszp9Xjh-GqrA',
                    'accept' => 'application/json',
                ],
            ]);
            $responseData = json_decode($response->getBody(), true);
            foreach ($responseData['results'] as $result) {
                if ($result['popularity']>7){
                    array_push($imagenes, $result);
                }
            }
            $pages++;
        } while ($pages <= $responseData['total_pages']);
        $indiceAleatorio = mt_rand(0, count($imagenes) - 1);
        return $imagenes[$indiceAleatorio]['backdrop_path'];
    }
}
