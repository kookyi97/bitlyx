<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla (importante para español)
    protected $table = 'lecciones';
=======
use Illuminate\Database\Eloquent\Model;


 // Representa una lección dentro de un módulo.
 
class Leccion extends Model
{
    protected $table = 'lecciones';
    public $timestamps = false;
>>>>>>> 8074006363a4f89c4d9d6e456069e7498cf1da13

    protected $fillable = ['modulo_id', 'titulo', 'contenido', 'orden'];

    public function modulo()
    {
<<<<<<< HEAD
        return $this->belongsTo(Modulo::class);
    }
}
=======
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }

    public function progreso()
    {
        return $this->hasMany(ProgresoUsuario::class, 'leccion_id');
    }
}
>>>>>>> 8074006363a4f89c4d9d6e456069e7498cf1da13
