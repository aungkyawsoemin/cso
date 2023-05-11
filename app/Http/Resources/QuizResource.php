<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\QuestionResource;

class QuizResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'status' => config('constants.STATUS')[$this->status],
            'level' => config('constants.QUIZ_LEVEL')[$this->level],
            'question_count' => $this->question_count,
            'thumbnail_url' => url($this->thumbnail_url),
            'questions' => QuestionResource::collection($this->showQuestions),
            'course_name' => $this->course_name,
            'course_description' => $this->course_description,
            'course_link' => $this->course_link,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
