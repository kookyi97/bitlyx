<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
     protected $table      = 'rol';
    protected $fillable   = ['nombre'];
    public    $timestamps = false;

    public function usuarios()
    {
        return $this->hasMany(User::class, 'rol_id');
    }
}