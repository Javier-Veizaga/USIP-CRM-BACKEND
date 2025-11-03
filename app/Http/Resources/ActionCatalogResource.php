<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActionCatalogResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'is_active'   => (bool) ($this->is_active ?? true),
            'created_at'  => $this->created_at?->timezone('America/La_Paz')->format('d/m/Y H:i'),
            'updated_at'  => $this->updated_at?->timezone('America/La_Paz')->format('d/m/Y H:i'),
        ];
    }
}
