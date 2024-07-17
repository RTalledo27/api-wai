<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyectos extends Model
{
    use HasFactory;
    protected $table = 'proyectos';

    protected $primaryKey = 'idProyecto';
    public $timestamps = true;
    protected $fillable = [
        'nombre_proyecto',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'idCliente',
        'idEstado',
        'idEmpleado'
    ];


    public function cliente(){
        return $this->belongsTo(Clientes::class, 'idCliente');
    }
    

    public function estado()
    {
        return $this->belongsTo(Estados::class, 'idEstado');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleados::class, 'idEmpleado');
    }

    public function cotizacion()
    {
        return $this->hasOne(Cotizaciones::class, 'idProyecto');
    }
    
}
