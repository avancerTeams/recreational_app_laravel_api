<?php

namespace App\Http\Resources\Review;

use App\Http\Resources\Recreation\RecreationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'authorId'     => (integer) $this->user_id,
            'recreationId' => (integer) $this->recreation_id,
            'rating'       => (integer) $this->rating,
            'comment'      => $this->comment,
            'author'       => $this->user->name,// new UserResource($this->user)
            'recreation'   => new RecreationResource($this->recreation),
            'url' => [
                'self' => route('reviews.show', $this),
                'index' => route('reviews.index', $this->recreation),
                // 'path' => $request->url(),
            ]
        ];
    }

    public function with($request) 
    {
        return [
            'version' => '1.0.0',
            'author' => 'Ibadan Dev Group',
        ];
    }
}
