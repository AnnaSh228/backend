<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaboratoryWorkResource extends JsonResource
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
            "title"=>$this->title,
            "deadline"=> $this->deadline,
            "maximum_score"=> $this->maximum_score,
            "discipline_id"=> $this->discipline_id,
           
     
           ];
    }
}
