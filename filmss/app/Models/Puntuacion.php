<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntuacion extends Model
{
    use HasFactory;
    protected $table='puntuaciones';
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
