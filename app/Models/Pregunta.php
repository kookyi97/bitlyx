<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table = 'preguntas';
    public $timestamps = false;
    protected $fillable = ['leccion_id', 'enunciado', 'xp'];

    public function opciones()
    {
        return $this->hasMany(Opcion::class, 'pregunta_id');
    }

    public function leccion()
    {
        return $this->belongsTo(Leccion::class, 'leccion_id');
    }
}