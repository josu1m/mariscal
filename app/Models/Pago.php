<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = ['estudiante_id', 'monto', 'pagado', 'descripcion', 'estado'];
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
    public function marcarComoPagado()
    {
        $this->estado = 'pagado';
        $this->pagado = true;
        $this->save();
    }
    public function getEstadoAttribute()
    {
        return $this->pagado ? 'pagado' : 'pendiente';
    }
}
