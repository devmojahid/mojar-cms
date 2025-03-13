<?php

namespace Mojahid\Lms\Http\Resources;

use Illuminate\Http\Request;
use Juzaweb\Backend\Http\Resources\PostResource;

/**
 * @property-read Course $resource
 */
class CourseCurriculumResource extends PostResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        // Get topics from the course
        $topics = TopicResource::collection($this->topics)->resolve();
        // items curriculum
        $items = CurriculumItemResource::collection($this->lessons)->resolve();
        
        return [
           'topics' => $topics,
           'items' => $items
        ];
    }
}
