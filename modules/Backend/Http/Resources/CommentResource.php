<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\Backend\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Juzaweb\Backend\Models\Comment;

/**
 * @property Comment $resource
 */
class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->getUserName(),
            'website' => $this->resource->website,
            'avatar' => $this->resource->getAvatar(),
            'content' => $this->resource->content,
        ];
    }
}
