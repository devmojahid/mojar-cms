<?php

namespace Mojahid\Lms\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurriculumItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? "",
            'type' => $this->type ?? "",
            'lesson_title' => $this->title ?? "",
            'order' => $this->order ?? 0,
            'topic_id' => $this->id ?? "",
            'created_at' => $this->created_at ?? "",
            'updated_at' => $this->updated_at ?? "",
            'content_url' => $this->content_url ?? null,
            'local_video_path' => $this->local_video_path ?? null,
            'thumbnail' => $this->thumbnail ?? null,
            'description' => $this->description ?? null,
            'duration' => $this->duration ?? 0,
            // Include type-specific fields
            'content' => $this->when($this->item_type === 'lesson', $this->content),
            'questions' => $this->when($this->item_type === 'quiz', $this->questions),
            'deadline' => $this->when($this->item_type === 'assignment', $this->deadline)
        ];
    }
}
