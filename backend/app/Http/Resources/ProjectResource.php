<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "project_name"=>$this->project_name,
            "project_status"=>$this->status_id==0?"Created":($this->status_id==1?"Running":($this->status_id==3?"Stopped":"Undefined")),
            "status_id"=>$this->status_id,
            "created_at"=>$this->created_at,
        ];
    }
}
