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
        // $data['topics'] = CourseTopicResource::collection($this->resource->topics)->resolve();
        dd($this->topics, $this->allItems);
        return [
           'topics' => TopicResource::collection($this->topics),
           'items' => CurriculumItemResource::collection($this->allItems)
        ];
    }
}
