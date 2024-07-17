<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizaciones extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'cotizaciones';
    protected $primaryKey = 'idCotizacion';
    public $timestamps = true;

    protected $fillable = [
        'idCliente',
        'idEmpleado',
        'idProyecto',
        'fecha_cotizacion',
        'descuento',
        'subtotal',
        'total',
        'idEstado'
    ];

   public function proyecto(){
        return $this->belongsTo(Proyectos::class, 'idProyecto');
    }

    public function elementos_cotizacion(){
        return $this->hasMany(Elementos_cotizacion::class, 'idCotizacion');
    }

}
