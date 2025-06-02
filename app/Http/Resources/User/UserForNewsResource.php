<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Subdivision\SubdivisionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserForNewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'login' => $this->login,
            'full_name' => $this->full_name,
            'subdivision' => SubdivisionResource::make($this->subdivision)->resolve(),
        ];
    }
}
