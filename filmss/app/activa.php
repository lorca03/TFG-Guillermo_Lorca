<?php

namespace App;

class Activa
{
    public static function comprobarActiva($ruta)
    {
        if (strpos($_SERVER['REQUEST_URI'] , $ruta)) {
            return true;
        }
    }
}
