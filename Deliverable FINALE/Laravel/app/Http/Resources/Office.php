<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Office extends JsonResource
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
            'floor' => $this->floor,
            'number' => $this->number,
            'markers_id' => $this->markers_id,
        ];
    }
}
