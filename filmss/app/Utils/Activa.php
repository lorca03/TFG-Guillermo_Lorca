<?php

namespace App\Utils;

class Activa
{
    public static function comprobarActiva($ruta)
    {
        if (strpos($_SERVER['REQUEST_URI'] , $ruta)) {
            return true;
        }
    }
}
