<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    
    protected $table = 'clientes';

    protected $primaryKey='idCliente';

    public $timestamps = true;

    protected $fillable  = [
        'nombre_cliente',
        'correo_cliente',
        'telefono_cliente',
        'dni_cliente',
       

    ];


    public function proyectos()
    {
        return $this->hasMany(Proyectos::class, 'idCliente'); 
    }

}
