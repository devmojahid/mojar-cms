<?php

namespace Mojahid\Lms\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title ?? "",
            'description' => $this->description ?? "",
            'order' => $this->order ?? 0,
            'status' => $this->status ?? "",
            'created_at' => $this->created_at ?? "",
            'updated_at' => $this->updated_at ?? ""
        ];
    }
}
