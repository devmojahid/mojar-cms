<?php

namespace Mojahid\Lms\Http\Resources;

use Illuminate\Http\Request;
use Juzaweb\Backend\Http\Resources\PostResource;

/**
 * @property-read Product $resource
 */
class ProductResource extends PostResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $data = parent::toArray($request);

        if ($this->resource->relationLoaded('downloadLinks')) {
            $data['download_links'] = DownloadLinkResource::collection($this->resource->downloadLinks)->resolve();
        }

        return $data;
    }
}
