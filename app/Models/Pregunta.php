<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table    = 'preguntas';
    public $timestamps  = false;
    protected $fillable = ['modulo_id', 'enunciado', 'xp'];

    public function opciones()
    {
        return $this->hasMany(Opcion::class, 'pregunta_id');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }
}
