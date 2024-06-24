<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'name' => $this->name,
            'image' => $this->image,
            'count' => $this->users->count(),
            'is_user_registered' => $this->isUserRegistered(),
            'user_course' => $this->whenLoaded('userCourses', function () {
                return $this->userCourses->where('user_id', auth()->id())->first();
            }),
        ];
    }
}