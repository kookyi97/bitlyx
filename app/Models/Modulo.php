<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo: Modulo
 * Persona 3 — Representa un módulo de aprendizaje.
 * Tabla: modulos
 */
class Modulo extends Model
{
    protected $table = 'modulos';
    public $timestamps = false; // la tabla usa created_at pero no updated_at

    protected $fillable = ['titulo', 'descripcion'];

    public function lecciones()
    {
        return $this->hasMany(Leccion::class, 'modulo_id')->orderBy('orden');
    }
}
