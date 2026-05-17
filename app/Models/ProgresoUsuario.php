<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


 // Registro de progreso de un usuario por lección.
 
class ProgresoUsuario extends Model
{
    protected $table = 'progreso_usuario';
    public $timestamps = false;

    protected $fillable = ['usuario_id', 'leccion_id', 'completada'];

    public function leccion()
    {
        return $this->belongsTo(Leccion::class, 'leccion_id');
    }

    public function usuario()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id');
    }
}
