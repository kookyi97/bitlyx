<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadoQuiz extends Model
{
    protected $table = 'resultados_quiz';
    
    public $timestamps = false;  // No usamos timestamps automáticos

    protected $fillable = [
        'usuario_id',
        'leccion_id',
        'correctas',
        'total',
        'xp_ganado',
        'fecha',  // ← Agregar fecha al fillable
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function leccion()
    {
        return $this->belongsTo(Leccion::class, 'leccion_id');
    }
}