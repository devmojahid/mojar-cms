<?php

namespace Mojahid\Lms\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        // Get pagination data if available
        $resource = $this->resource;
        $isPaginated = method_exists($resource, 'currentPage');
        
        $data = [
            'data' => $this->collection->map(function ($course) {
                return (new CourseResource($course))->toArray($course);
            })
        ];
        
        // Add pagination information if the resource is paginated
        if ($isPaginated) {
            $data['pagination'] = [
                'total' => $resource->total(),
                'count' => $resource->count(),
                'per_page' => $resource->perPage(),
                'current_page' => $resource->currentPage(),
                'total_pages' => $resource->lastPage()
            ];
        } else {
            $data['pagination'] = [
                'total' => $resource->count(),
                'count' => $resource->count(),
                'per_page' => 10,
                'current_page' => 1,
                'total_pages' => 1
            ];
        }
        
        return $data;
    }
} 