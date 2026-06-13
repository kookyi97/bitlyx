<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class IntentoQuiz extends Model
{
    protected $table    = 'intentos_quiz';
    public $timestamps  = false;

    protected $fillable = [
        'usuario_id', 'modulo_id', 'correctas', 'total', 'xp_ganado', 'fecha',
    ];

    protected $casts = ['fecha' => 'datetime'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }

    public function getPorcentajeAttribute(): int
    {
        return $this->total > 0 ? (int) round($this->correctas / $this->total * 100) : 0;
    }
}
