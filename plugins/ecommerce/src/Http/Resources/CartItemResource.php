<?php

namespace Mojahid\Ecommerce\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'post_id' => $this->post_id,
            'type' => $this->type,
            'title' => $this->title,
            'thumbnail' => upload_url($this->thumbnail),
            'price' => ecom_price_with_unit($this->price),
            'price_without_unit' => $this->price,
            'quantity' => (int)$this->quantity,
            'line_price' => ecom_price_with_unit($this->line_price),
            'line_price_without_unit' => $this->line_price,
            'sku_code' => $this->sku_code,
            'barcode' => $this->barcode,
            'url' => $this->url,
        ];
    }
} 