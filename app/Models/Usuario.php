<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol_id',
        'xp_total',
        'activo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = ['created_at'];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
}