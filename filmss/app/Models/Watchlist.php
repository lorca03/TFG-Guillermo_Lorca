<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    use HasFactory;
    protected $table='watchlists';
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function registros($id)
    {
        return $this->where('user_id',$id)->get();
    }
}
