<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return[
        "id"=> $this->id,
        "comment"=> $this->comment,
        "date_of_lesson"=> $this->date_of_lesson,
        "lesson_type_id"=> $this->lesson_type_id,
        "academic_load_id"=> $this->academic_load_id,
        "lists"=> RatedListsResource::collection($this->lists),
       ];
    }
}
