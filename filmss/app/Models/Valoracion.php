<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Valoracion extends Model
{
    use HasFactory;
    protected $table='valoraciones';
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public static function valorada($contenido)
    {
        return self::where('user_id',Auth::id())->where('contenido',$contenido)->get();
    }
    public static function calificacion($contenido)
    {
        $valoraciones = self::where('contenido',$contenido)->get();
        $calificacion = 0;
        foreach ($valoraciones as $valoracion){
            $calificacion +=$valoracion->valoracion;
        }
        return count($valoraciones)==0?false:number_format($calificacion/ (float) count($valoraciones),1);
    }
}
