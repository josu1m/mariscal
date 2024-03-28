<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'fecha_fin',
        'estado_actividad',
    ];

    public function actividads()
    {
        return $this->hasMany(Actividad::class);
    }
}
