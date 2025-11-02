<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                 => $this->id,
            'first_name'         => $this->first_name,
            'last_name'          => $this->last_name,
            'maternal_last_name' => $this->maternal_last_name,
            'full_name'          => $this->full_name, // accessor del modelo
            'email'              => $this->email,
            'phone'              => $this->phone,
            'is_active'          => (bool) $this->is_active,
            'role' => [
                'id'   => $this->role_id,
                'code' => optional($this->role)->code,
                'name' => optional($this->role)->name,
            ],
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
