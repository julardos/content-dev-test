<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->whenHas('email'),
            'name' => $this->whenHas('name'),
            'is_content_creator' => $this->whenHas('is_content_creator'),
            'profile' => $this->whenHas('is_content_creator') && $this->is_content_creator ? $this->profile : null,
        ];
    }
}
