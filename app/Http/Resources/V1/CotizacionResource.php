<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CotizacionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                'idCotizacion' => $this->idCotizacion,
            'fecha_cotizacion' => $this->fecha_cotizacion,
            'subtotal' => $this->subtotal,
            'descuento'=> $this->descuento,
            'total' => $this->total,
            'proyecto' => $this->proyecto,
            
            'elementos'=> $this->elementos_cotizacion,  
        
        ];
    }
}
