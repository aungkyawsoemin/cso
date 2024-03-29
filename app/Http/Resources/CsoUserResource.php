<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\QuestionResource;

class CsoUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'division' => $this->division,
            'occupication' => $this->occupication,
            'gender' => $this->gender,
            'age' => $this->age,
            'ethnicity' => $this->ethnicity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
