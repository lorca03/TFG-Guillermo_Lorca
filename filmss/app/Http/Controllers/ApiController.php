<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    var $cliente;
    var $config;
    var $headers;

    function __construct()
    {
        $this->cliente = new \GuzzleHttp\Client();
        $this->config = [
            'date' => date('Y-m-d'),
            'adult' => '&include_adult=false',
            'language' => '&language=es',
            'region' => '&region=ES&watch_region=ES',
        ];
        $this->headers = [
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmZDRmNDE2NWI0N2YzNDkyZGNmMDE3MWJjMGZkYWQ4MyIsInN1YiI6IjY0NWJkNDc2NmFhOGUwMDBlNGJlMzU4NiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.yzENA_sZUyHmedM3zgZFWMMae4JvCzKszp9Xjh-GqrA',
            'accept' => 'application/json',
        ];
    }

    /**
     *
     */
    public function search(Request $request)
    {
        $busqueda = $request->input('s');
        $filtrar = $request->input('filtrar');
        $opcionesFiltrar = [
            'todo' => 'multi',
            'peliculas' => 'movie',
            'series' => 'tv',
            'personas' => 'person',
        ];
        $filtrar = $filtrar!="" ? $filtrar: "todo";
        $resultado = [];
        $pages = 1;
        $apiUrl = 'https://api.themoviedb.org/3/search/' . $opcionesFiltrar[$filtrar] . '?query=' . $busqueda . '&include_adult=false&language=es&watch_region=es&page=';
        do {
            $response = $this->cliente->request('GET', $apiUrl . $pages, [
                'headers' => $this->headers,
            ]);
            $responseData = json_decode($response->getBody(), true);
            foreach ($responseData['results'] as $result) {
               //var_dump($result);
                array_push($resultado, $result);
            }
            $pages++;
            $total_pages = $responseData['total_pages'];
        } while ($pages <= $total_pages);

        usort($resultado, function ($a, $b) {
            if (isset($a['popularity']) && isset($b['popularity'])) {
                return $b['popularity'] - $a['popularity'];
            }
        });
        return view('/pages.buscar', ['resultado' => $resultado, 'filtrar' => ($filtrar=="todo" ? false:$opcionesFiltrar[$filtrar])]);
    }

    /**
     *
     */
    public function home()
    {
        $resultado = $this->añadirPeliculas([], 1, $this->config);
        $resultado = $this->añadirTV($resultado, 1, $this->config);
        usort($resultado, function ($a, $b) {
            $fecha2 = isset($b['release_date']) ? strtotime($b['release_date']) : strtotime($b['first_air_date']);
            $fecha1 = isset($a['release_date']) ? strtotime($a['release_date']) : strtotime($a['first_air_date']);
            return $fecha2 - $fecha1;
        });
        $imagen = ImagenAleatoriaController::home($this->cliente);
        return view('/pages.home', ['resultado' => $resultado, 'imagen_aleatoria' => $imagen]);
    }

    public function obtenerMasResultados(Request $request)
    {
        $pagina = $request->input('pagina');
        $resultado = $this->añadirPeliculas([], $pagina, $this->config);
        $resultado = $this->añadirTV($resultado, $pagina, $this->config);
        return response()->json($resultado);
    }

    public function añadirPeliculas($resultado, $pages, $config)
    {
        $apiUrl = 'https://api.themoviedb.org/3/discover/movie?&primary_release_date.lte=' . $config['date']
            . $config['adult'] . $config['language'] . $config['region'];
        $response = $this->cliente->request('GET', $apiUrl . '&page=' . $pages, [
            'headers' => $this->headers,
        ]);
        $responseData = json_decode($response->getBody(), true);
        foreach ($responseData['results'] as $result) {
            $result['media_type']='movie';
            array_push($resultado, $result);
        }
        $total_pages = $responseData['total_pages'];
        return $resultado;
    }

    public function añadirTV($resultado, $pages, $config)
    {
        $apiUrl = 'https://api.themoviedb.org/3/discover/tv?&first_air_date.lte=' . $config['date'] . '&with_origin_country=US'
            . $config['adult'] . $config['language'] . $config['region'];
        $response = $this->cliente->request('GET', $apiUrl . '&page=' . $pages, [
            'headers' => $this->headers,
        ]);
        $responseData = json_decode($response->getBody(), true);
        foreach ($responseData['results'] as $result) {
            $result['media_type']='tv';
            array_push($resultado, $result);
        }
        $total_pages = $responseData['total_pages'];
        return $resultado;
    }

    public function consulta($url)
    {
        $response = $this->cliente->request('GET', $url , [
            'headers' => $this->headers,
        ]);
        return json_decode($response->getBody(), true);
    }
    /**
     * Busacmos las peliculas y series tendencia
     */
    public function tendencias(Request $request)
    {
        $apiUrl = 'https://api.themoviedb.org/3/trending/movie/week?'. $this->config['language'];
        $response = $this->cliente->request('GET', $apiUrl, [
            'headers' => $this->headers,
        ]);
        $responseData = json_decode($response->getBody(), true);
        $movies = $responseData['results'];
        // Ordenar las películas por popularidad en orden descendente
        usort($movies, function ($a, $b) {
            return $b['popularity'] <=> $a['popularity'];
        });
        $apiUrl = 'https://api.themoviedb.org/3/trending/tv/week?'. $this->config['language'];
        $response = $this->cliente->request('GET', $apiUrl, [
            'headers' => $this->headers,
        ]);
        $responseDataS = json_decode($response->getBody(), true);
        $series = $responseDataS['results'];
        // Ordenar las películas por popularidad en orden descendente
        usort($series, function ($a, $b) {
            return $b['popularity'] <=> $a['popularity'];
        });
        // Obtener las primeras 10 películas más populares
        $topMovies = array_slice($movies, 0, 10);
        $topSeries = array_slice($series, 0, 10);
//        var_dump($topMovies);
//        echo '<br />';
//        var_dump($topSeries);
        return view('/pages.tendencias', ['imagen_aleatoria' => ImagenAleatoriaController::tendencias(),
            'peliculas'=>$topMovies,
            'series'=>$topSeries,]);
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
