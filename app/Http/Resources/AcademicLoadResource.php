<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AcademicLoadResource extends JsonResource
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
            "user_id"=> $this->user_id,
            "discipline_id"=> $this->discipline_id,
            "study_group_id"=> $this->study_group_id
         
           ];
    }
}
