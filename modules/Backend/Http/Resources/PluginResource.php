<?php

namespace Juzaweb\Backend\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class PluginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->resource['name'],
            'title' => $this->resource['title'],
            'description' => $this->resource['description'],
            'thumbnail' => $this->resource['thumbnail'] ?? null,
            'banner' => $this->resource['banner'] ?? null,
            'url' => $this->resource['url'] ?? null,
            'is_paid' => $this->resource['is_paid'] ?? null,
            'price' => $this->resource['price'] ?? null,
            'created_at' => Carbon::parse($this->resource['created_at'])->format('M j, Y g:i a'),
            'updated_at' => Carbon::parse($this->resource['updated_at'])->format('M j, Y g:i a'),
        ];
    }
}
