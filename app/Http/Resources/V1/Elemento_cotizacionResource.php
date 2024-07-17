<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\V1\CotizacionResource;
use App\Http\Resources\V1\ElementoResource;

class Elemento_cotizacionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'idElementoCotizacion' => $this->idElemento_cotizacion,
            'idCotizacion'=> $this->idCotizacion,
            'idElemento' => $this->idElemento,
            'elementos'=> new ElementoResource($this->elemento),
        ];
    }
}
