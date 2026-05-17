<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    use HasFactory;

    protected $table = 'lecciones';
    protected $fillable = ['modulo_id', 'titulo', 'contenido', 'orden'];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }
}