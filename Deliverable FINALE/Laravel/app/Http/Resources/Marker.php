<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Marker extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'type' => $this->type,
            'services_id' => $this->services_id,
        ];
    }
}
