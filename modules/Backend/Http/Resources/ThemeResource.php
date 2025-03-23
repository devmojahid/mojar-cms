<?php

namespace Juzaweb\Backend\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ThemeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->resource['name'],
            'title' => $this->resource['title'],
            'description' => $this->resource['description'],
            'screenshot' => $this->resource['screenshot'] ? $this->resource['screenshot'] : 
                            ($this->resource['screenshot_path'] ? upload_url($this->resource['screenshot_path']) : null),
            'banner' => $this->resource['banner'],
            'url' => $this->resource['url'],
            'is_paid' => $this->resource['is_paid'],
            'price' => $this->resource['price'],
            'created_at' => Carbon::parse($this->resource['created_at'])->format('M j, Y g:i a'),
            'updated_at' => Carbon::parse($this->resource['updated_at'])->format('M j, Y g:i a'),
        ];
    }
}
