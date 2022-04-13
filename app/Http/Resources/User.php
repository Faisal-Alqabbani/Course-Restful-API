<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Lesson as LessonResurece; 
class User extends JsonResource
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
            'Full_name' => $this->name,
            "E-mail" => $this->email, 
            "Lesosns" => LessonResurece::collection($this->lessons),
        ];
    }
}
