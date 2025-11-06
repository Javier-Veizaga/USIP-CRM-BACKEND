<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'semesters' => $this->semesters,
            'faculty'   => $this->whenLoaded('faculty', fn() => [
                'id' => $this->faculty->id, 'name' => $this->faculty->name,
            ]),
            'created_at'=> $this->created_at?->timezone('America/La_Paz')->format('d/m/Y H:i'),
            'updated_at'=> $this->updated_at?->timezone('America/La_Paz')->format('d/m/Y H:i'),
        ];
    }
}
