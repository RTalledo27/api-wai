<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ElementoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'idElemento' => $this->idElemento,
            'nombre_elemento' => $this->nombre_elemento,
            'descripcion'=>$this->descripcion,
            'costo'=>$this->costo,
            'isActive'=>$this->isActive,
        ];
    }
}
