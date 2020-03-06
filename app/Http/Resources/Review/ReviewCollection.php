<?php

namespace App\Http\Resources\Review;

// use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'rating'       => (integer) $this->rating,
            'comment'      => $this->comment,
            'author'       => $this->user->name,
            'recreation'   => $this->recreation->name,
            'url' => [
                'self' => route('reviews.show', $this),
                'index' => route('reviews.index', $this->recreation),
                'recreation' => route('recreations.show', $this->recreation),
                'path' => $request->url(),
            ]
        ];
    }
}
