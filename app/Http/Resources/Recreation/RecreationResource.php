<?php

namespace App\Http\Resources\Recreation;

use Illuminate\Http\Resources\Json\JsonResource;

class RecreationResource extends JsonResource
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
            'name'        => $this->name,
            'address'     => $this->address,
            'locationId'  => (integer) $this->location_id,
            'categoryId'  => (integer) $this->category_id,
            'active'      => (boolean) $this->isActive(),
            'openingHour' => $this->opening_hour,
            'closingHour' => $this->closing_hour,
            'url' => [
                'self' => route('recreations.show', $this),
                'index' => route('recreations.index'),
                'reviews' => route('reviews.index', $this),
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
