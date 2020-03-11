<?php

namespace App\Http\Resources\Location;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'name'        => $this->name,
            'url' => [
                'self' => route('locations.show', $this),
                'index' => route('locations.index'),
                'recreations' => route('recreations.location', $this),
            ]
        ];
    }
}
