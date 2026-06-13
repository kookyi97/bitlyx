<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadoQuiz extends Model
{
    protected $table = 'resultados_quiz';
    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'modulo_id',
        'correctas',
        'total',
        'xp_ganado',
        'fecha',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }
}