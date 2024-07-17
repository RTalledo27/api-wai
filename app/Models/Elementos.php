<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elementos extends Model
{
    use HasFactory;

    protected $table = 'elementos';

    protected $primaryKey = 'idElemento';

    protected $fillable =[
        'nombre_elemento',
        'descripcion',
        'costo',
        'isActive'
    ];

    public function elemento_cotizacion(){
        return $this->hasMany(Elementos_cotizacion::class, 'idElemento');
    }
    
}
