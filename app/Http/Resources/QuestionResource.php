<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\QuestionItemResource;

class QuestionResource extends JsonResource
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
            'title' => $this->title,
            'correct_description' => $this->correct_description,
            'status' => config('constants.STATUS')[$this->status],
            'score' => $this->score,
            'type' => $this->type,
            'thumbnail_url' => url($this->thumbnail_url),
            'items' => QuestionItemResource::collection($this->showItems),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
