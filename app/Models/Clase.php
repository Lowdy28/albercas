<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'classes';

    // Campos que se pueden llenar de forma masiva
    protected $fillable = [
        'fecha',                // Fecha de la clase
        'id_profesor',          // ID del usuario que imparte la clase
        'tipo',                 // Tipo de clase (e.g., yoga, spinning)
        'lugares',              // Total de lugares disponibles
        'lugares_ocupados',     // Lugares ya reservados
        'lugares_disponibles'   // Lugares aún libres
    ];

    // Relación con el modelo User (profesor)
    public function profesor()
    {
        return $this->belongsTo(User::class, 'id_profesor');
        // belongsTo indica que esta clase "pertenece a" un usuario (el profesor)
        // El segundo parámetro indica que la clave foránea es id_profesor en esta tabla
    }
}
