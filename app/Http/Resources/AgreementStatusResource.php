<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AgreementStatusResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name, // Ej: Active, Cancelled, Expired
            'description' => $this->description,
            'created_at'  => $this->created_at?->timezone('America/La_Paz')->format('d/m/Y H:i'),
            'updated_at'  => $this->updated_at?->timezone('America/La_Paz')->format('d/m/Y H:i'),
        ];
    }
}
