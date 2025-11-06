<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProspectResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'maternal_last_name' => $this->maternal_last_name,
            'full_name'  => trim($this->first_name.' '.$this->last_name.' '.($this->maternal_last_name ?? '')),

            'phone'      => $this->phone,
            'address'    => $this->address,

            'school'     => $this->whenLoaded('school', fn() => [
                'id' => $this->school->id, 
                'name' => $this->school->name
            ]),
            'origin'     => $this->whenLoaded('origin', fn() => [
                'id' => $this->origin->id, 'name' => $this->origin->name
            ]),
            'executive'  => $this->whenLoaded('executive', fn() => [
                'id' => $this->executive->id, 'email' => $this->executive->email,
                'full_name' => method_exists($this->executive,'getFullNameAttribute') ? $this->executive->full_name : null
            ]),
            'status'     => $this->whenLoaded('status', fn() => [
                'id' => $this->status->id, 'status' => $this->status->status
            ]),

            'created_at' => $this->created_at?->timezone('America/La_Paz')->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at?->timezone('America/La_Paz')->format('d/m/Y H:i'),
        ];
    }
}
