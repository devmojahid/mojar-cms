<?php

namespace Mojahid\Ecommerce\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'key' => $this['type'] . '_' . $this['post_id'],
            'post_id' => $this['post_id'],
            'type' => $this['type'],
            'quantity' => (int) $this['quantity'],
            'title' => (string) $this['title'],
            'thumbnail' => upload_url($this['thumbnail']),
            'compare_price' => (float) ($this['compare_price'] ?? 0),
            'compare_price_formatted' => ecom_price_with_unit($this['compare_price'] ?? 0),
            'pricing' => [
                'unit_price' => (float) $this['price'],
                'unit_price_formatted' => ecom_price_with_unit($this['price']),
                'line_price' => (float) ($this['price'] * $this['quantity']),
                'line_price_formatted' => ecom_price_with_unit($this['price'] * $this['quantity']),
                'compare_price' => (float) ($this['compare_price'] ?? 0),
                'compare_price_formatted' => ecom_price_with_unit($this['compare_price'] ?? 0),
            ],
            'metadata' => $this['metadata'],
        ];
    }
}
