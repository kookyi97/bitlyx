<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


 // Representa una lección dentro de un módulo.
 
class Leccion extends Model
{
    protected $table = 'lecciones';
    public $timestamps = false;

    protected $fillable = ['modulo_id', 'titulo', 'contenido', 'orden'];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }

    public function progreso()
    {
        return $this->hasMany(ProgresoUsuario::class, 'leccion_id');
    }
}
