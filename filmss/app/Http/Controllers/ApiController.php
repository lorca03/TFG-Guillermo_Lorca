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
    public function home(Request $request)
    {
        $filtrar = $request->input('filtrar')==null?'todo':$request->input('filtrar');
        $genero = $request->input('genero');
        $plataformas = $request->input('plataforma');
        if ($filtrar=='peliculas' || $filtrar=='todo'){
            $resultado = $this->añadirPeliculas([], 1, $this->config,$genero,$plataformas);
        }
        if ($filtrar=='series' || $filtrar=='todo'){
        $resultado = $this->añadirTV(isset($resultado)?$resultado:[], 1, $this->config,$genero,$plataformas);
        }
        usort($resultado, function ($a, $b) {
            $fecha2 = isset($b['release_date']) ? strtotime($b['release_date']) : strtotime($b['first_air_date']);
            $fecha1 = isset($a['release_date']) ? strtotime($a['release_date']) : strtotime($a['first_air_date']);
            return $fecha2 - $fecha1;
        });
        $imagen = ImagenAleatoriaController::home($this->cliente);
        $aplicaciones = self::aplicaciones();
        return view('/pages.home', ['resultado' => $resultado, 'imagen_aleatoria' => $imagen,'aplicaciones' => $aplicaciones]);
    }

    public function obtenerMasResultados(Request $request)
    {
        $pagina = $request->input('pagina');
        $filtrar = $request->input('filtrar')==null?'todo':$request->input('filtrar');
        $genero = $request->input('genero');
        $plataformas = $request->input('plataforma');
        if ($filtrar=='peliculas' || $filtrar=='todo'){
            $resultado = $this->añadirPeliculas([], $pagina, $this->config,$genero,$plataformas);
        }
        if ($filtrar=='series' || $filtrar=='todo'){
            $resultado = $this->añadirTV(isset($resultado)?$resultado:[], $pagina, $this->config,$genero,$plataformas);
        }
        usort($resultado, function ($a, $b) {
            $fecha2 = isset($b['release_date']) ? strtotime($b['release_date']) : strtotime($b['first_air_date']);
            $fecha1 = isset($a['release_date']) ? strtotime($a['release_date']) : strtotime($a['first_air_date']);
            return $fecha2 - $fecha1;
        });
        return response()->json($resultado);
    }

    public function añadirPeliculas($resultado, $pages, $config, $genero,$plataformas)
    {
        $apiUrl = 'https://api.themoviedb.org/3/discover/movie?&primary_release_date.lte=' . $config['date']
            . $config['adult'] . $config['language'] . $config['region'];
        if (!empty($genero)) {
            $generosIds = $this->obtenerGeneroId($genero);
            $apiUrl .= '&with_genres=' . $generosString = implode(',', $generosIds);
        }
        if (!empty($plataformas)) {
            $apiUrl .= '&with_watch_providers=' . $plataformas;
        }
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

    public function añadirTV($resultado, $pages, $config,$genero,$plataformas)
    {
        $apiUrl = 'https://api.themoviedb.org/3/discover/tv?&first_air_date.lte=' . $config['date'] . '&with_origin_country=US'
            . $config['adult'] . $config['language'] . $config['region'];
        if (!empty($genero)) {
            $generosIds = $this->obtenerGeneroId($genero);
            $apiUrl .= '&with_genres=' . $generosString = implode(',', $generosIds);
        }
        if (!empty($plataformas)) {
            $apiUrl .= '&with_watch_providers=' . $plataformas;
        }
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
        return view('/pages.tendencias', ['imagen_aleatoria' => ImagenAleatoriaController::tendencias(),
            'peliculas'=>$topMovies,
            'series'=>$topSeries,]);
    }

    /**
     * Display the specified resource.
     */
    public function aplicaciones()
    {
        $apiUrl = 'https://api.themoviedb.org/3/watch/providers/movie?language=en-US&watch_region=es';
        $response = $this->cliente->request('GET', $apiUrl, [
            'headers' => $this->headers,
        ]);
        if ($response) {
            $data = json_decode($response->getBody(), true);
            $aplicaciones = [];
            if (isset($data['results'])) {
                for ($i = 0; $i < 20; $i++){
                    array_push($aplicaciones,$data['results'][$i]);
                }
            }
            return $aplicaciones;
        } else {
            echo "Error al realizar la solicitud a la API.";
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public static function generos()
    {
        $apiUrl = 'https://api.themoviedb.org/3/genre/movie/list?language=es';
        $cliente = new \GuzzleHttp\Client();
        $response = $cliente->request('GET', $apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmZDRmNDE2NWI0N2YzNDkyZGNmMDE3MWJjMGZkYWQ4MyIsInN1YiI6IjY0NWJkNDc2NmFhOGUwMDBlNGJlMzU4NiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.yzENA_sZUyHmedM3zgZFWMMae4JvCzKszp9Xjh-GqrA',
                'accept' => 'application/json',
            ]
        ]);
        if ($response) {
            $data = json_decode($response->getBody(), true);
            $generos = [];
            if (isset($data['genres'])) {
                for ($i = 0; $i < 15; $i++){
                    array_push($generos,$data['genres'][$i]['name']);
                }
            }
            return $generos;
        } else {
            echo "Error al realizar la solicitud a la API.";
        }
    }

    function obtenerGeneroId($nombreGeneros) {
        $generos = explode(',', $nombreGeneros);
        $apiUrl = 'https://api.themoviedb.org/3/genre/movie/list?language=es';
        $response = $this->cliente->request('GET', $apiUrl, [
            'headers' => $this->headers,
        ]);
        $data = json_decode($response->getBody(), true);
        $generosIds = [];
        foreach ($generos as $genero) {
            $genero = trim($genero);
            foreach ($data['genres'] as $genre) {
                if (strcasecmp($genre['name'], $genero) === 0) {
                    $generosIds[] = $genre['id'];
                    break;
                }
            }
        }
        return $generosIds;
    }

    /**
     * Update the specified resource in storage.
     */
    public static function paises()
    {
        $apiUrl = 'https://api.themoviedb.org/3/configuration/countries';
        $cliente = new \GuzzleHttp\Client();
        $response = $cliente->request('GET', $apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmZDRmNDE2NWI0N2YzNDkyZGNmMDE3MWJjMGZkYWQ4MyIsInN1YiI6IjY0NWJkNDc2NmFhOGUwMDBlNGJlMzU4NiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.yzENA_sZUyHmedM3zgZFWMMae4JvCzKszp9Xjh-GqrA',
                'accept' => 'application/json',
            ]
        ]);
        if ($response) {
            $countries  = json_decode($response->getBody(), true);
            $paises = [];
            foreach ($countries as $country) {
                array_push($paises,$country['iso_3166_1'] . PHP_EOL);
            }
            return $paises;
        } else {
            echo "Error al realizar la solicitud a la API.";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
