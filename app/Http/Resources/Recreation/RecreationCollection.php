<?php

namespace App\Http\Resources\Recreation;

// use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class RecreationCollection extends JsonResource
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
            'name' => $this->name,
            'address' => $this->address,
            'locationId' => $this->location_id,
            'categoryId' => $this->category_id,
            'url' => [
                'self' => route('recreations.show', $this),
                'path' => $request->url(),
            ]
        ];
    }
}
