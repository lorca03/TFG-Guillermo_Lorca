<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagenAleatoriaController extends Controller
{
    /**
     * Genera una vista de la página 'pages.tendencias' con una imagen aleatoria de la matriz $imagenes.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public static function tendencias()
    {
        $imagenes = array('images/tendenciasAmigos2.jpg', 'images/tendenciasCafe.jpg');
        // Genera un índice aleatorio dentro del rango de la matriz $imagenes
        $indice = mt_rand(0, count($imagenes) - 1);
        return $imagenes[$indice];
    }
    /**
     * Obtiene una imagen aleatoria utilizando la API de The Movie DB.
     *
     * @param  mixed  $cliente  Objeto cliente para realizar la solicitud a la API.
     * @return string|null       Ruta de la imagen seleccionada aleatoriamente o null si no se encontraron imágenes.
     */
    public static function home($cliente)
    {
        $imagenes = array();
        $genero = mt_rand(0, 1) == 0 ? 'tv' : 'movie';
        // Inicializa el contador de páginas y construye la URL de la API
        $pages = 1;
        $apiUrl = 'https://api.themoviedb.org/3/discover/' . $genero . '?include_adult=false&language=es&region=US&sort_by=popularity.desc&vote_average.gte=8&vote_count.gte=300&watch_region=US&page=';
        do {
            // Realiza una solicitud GET a la API utilizando el cliente proporcionado
            $response = $cliente->request('GET', $apiUrl . $pages, [
                'headers' => [
                    'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmZDRmNDE2NWI0N2YzNDkyZGNmMDE3MWJjMGZkYWQ4MyIsInN1YiI6IjY0NWJkNDc2NmFhOGUwMDBlNGJlMzU4NiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.yzENA_sZUyHmedM3zgZFWMMae4JvCzKszp9Xjh-GqrA',
                    'accept' => 'application/json',
                ],
            ]);
            // Decodifica la respuesta JSON obtenida
            $responseData = json_decode($response->getBody(), true);
            // Recorre los resultados y agrega las imágenes con popularidad mayor a 7 a la matriz $imagenes
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
