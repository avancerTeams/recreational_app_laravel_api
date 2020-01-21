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
            'locationId'  => $this->location_id,
            'categoryId'  => $this->category_id,
            'active'      => $this->isActive(),
            'openingHour' => $this->opening_hour,
            'closingHour' => $this->closing_hour,
            'url' => [
                'self' => route('recreations.show', $this),
                'index' => route('recreations.index'),
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
