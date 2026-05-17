<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    public $timestamps = false;  // ← DESACTIVA TIMESTAMPS

    protected $table = 'modulos';
    protected $fillable = ['titulo', 'descripcion'];

    public function lecciones()
    {
        return $this->hasMany(Leccion::class, 'modulo_id')->orderBy('orden');
    }
}