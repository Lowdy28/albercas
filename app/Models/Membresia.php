<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 4️⃣ Definición de clase modelo
class Membresia extends Model  // Hereda de Eloquent para usar funcionalidades ORM
{
   //  Nombre de la tabla real en la base de datos
    protected $table = 'memberships';
    
    // 6️⃣ Campos que se pueden llenar de forma masiva
    protected $fillable = [
        'id_usuario',           // ID del usuario dueño de esta membresía
        'clases_adquiridas',    // Total de clases compradas
        'clases_disponibles',   // Clases que aún puede usar
        'clases_ocupadas',      // Clases que ya ha usado o reservado
    ];
    // Esto sirve como protección. Solo estos campos pueden llenarse al crear o actualizar con métodos como create(), update(), etc.
    // Protege contra asignación masiva de campos sensibles que no deberían cambiarse así.

    // 7️⃣ Relación con el modelo User
    public function user()  // Método para obtener el usuario relacionado a esta membresía
    {
        // Establece una relación: esta membresía pertenece a un usuario
        return $this->belongsTo(User::class);
        // belongsTo es un método de Eloquent que crea una relación de muchos a uno.
        // Laravel espera que haya una columna 'id_usuario' en la tabla 'memberships' que apunte a un 'id' en la tabla 'users'.
        // Te permite hacer: $membresia->user para acceder al usuario dueño de la membresía.
    }
}
