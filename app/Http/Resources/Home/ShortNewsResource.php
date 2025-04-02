<?php

namespace App\Http\Resources\Home;

use App\Http\Resources\User\UserForNewsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortNewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'user' => UserForNewsResource::make($this->user)->resolve(),
            'date' => 111111,
        ];
    }
}
