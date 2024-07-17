<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elementos_cotizacion extends Model
{
    use HasFactory;

    protected $table = 'elementos_cotizacion';

    protected $primaryKey = 'idElementoCotizacion';
    public $timestamps = true;
    protected $fillable = [
        'idCotizacion',
        'idElemento',
        
    ];

    public function cotizacion()
    {
        return $this->belongsTo(Cotizaciones::class, 'idCotizacion');
    }

    public function elemento()
    {
        return $this->belongsTo(Elementos::class, 'idElemento');
    }
}
