<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ResultadoQuiz extends Model
{
    protected $table = 'resultados_quiz';
    public $timestamps = false;
    protected $fillable = [
        'usuario_id', 'leccion_id',
        'correctas', 'total', 'xp_ganado',
    ];
}