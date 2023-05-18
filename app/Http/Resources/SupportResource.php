<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class SupportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'status_label' =>             
                isset($this->statusOptions[$this->status])
                ? $this->statusOptions[$this->status]
                : 'Not Found Status',
            'description' => $this->description,
            'user' => new UserResource($this->user),
            'lesson' => new LessonResource($this->lesson),
            'replies' => LessonResource::collection($this->replies),
            'dt_updated' => Carbon::make($this->updated_at)->format('Y-m-d H:i:s')
        ];
    }
}
