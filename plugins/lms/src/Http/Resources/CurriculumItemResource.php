<?php

namespace Mojahid\Lms\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurriculumItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? "",
            'type' => $this->item_type ?? "",
            'title' => $this->title ?? "",
            'order' => $this->order ?? 0,
            'topic_id' => $this->topic_id ?? "",
            'created_at' => $this->created_at ?? "",
            'updated_at' => $this->updated_at ?? "",
            // Include type-specific fields
            'content' => $this->when($this->item_type === 'lesson', $this->content),
            'questions' => $this->when($this->item_type === 'quiz', $this->questions),
            'deadline' => $this->when($this->item_type === 'assignment', $this->deadline)
        ];
    }
}
