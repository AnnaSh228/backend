<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RatedResource extends JsonResource
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
            "mark"=> $this->mark,
            "comment"=> $this->comment,
            "lesson_id"=> $this->lesson_id,
            "laboratory_work_id"=> $this->laboratory_work_id,
            "user_id"=> $this->user_id,
           ];
    }
}
