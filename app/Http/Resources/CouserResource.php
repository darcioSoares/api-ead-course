<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CouserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        //return parent::toArray($request);

        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'description'=> $this->description,
            'image'=> $this->image ? Storage::url($this->image) : ''
        ];

    }
}
