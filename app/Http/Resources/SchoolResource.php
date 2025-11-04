<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SchoolResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                 => $this->id,
            'name'               => $this->name,
            'address'            => $this->address,
            'management'         => $this->whenLoaded('management', fn() => [
                'id'   => $this->management->id,
                'name' => $this->management->name,
            ]),
            'shift'              => $this->whenLoaded('shift', fn() => [
                'id'   => $this->shift->id,
                'name' => $this->shift->name,
            ]),
            'agreement_type'     => $this->whenLoaded('agreementType', fn() => [
                'id'   => $this->agreementType->id,
                'name' => $this->agreementType->name,
            ]),
            'agreement_status'   => $this->whenLoaded('agreementStatus', fn() => [
                'id'   => $this->agreementStatus->id,
                'name' => $this->agreementStatus->name,
            ]),
            'created_at'         => $this->created_at?->timezone('America/La_Paz')->format('d/m/Y H:i'),
            'updated_at'         => $this->updated_at?->timezone('America/La_Paz')->format('d/m/Y H:i'),
        ];
    }
}
