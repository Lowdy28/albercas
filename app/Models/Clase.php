<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $table = 'classes';
    protected $fillable = [
        'fecha', 
        'id_profesor',
        'tipo',
        'lugares', 
        'lugares_ocupados', 
        'lugares_disponibles' 
    ];

    public function profesor()
    {
        return $this->belongsTo(User::class, 'id_profesor');
       
    }
}
