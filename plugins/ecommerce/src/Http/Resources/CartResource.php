<?php

namespace Mojahid\Ecommerce\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'code' => $this->resource->getCode(),
            'total_items' => $this->resource->totalItems(),
            'total_price' => ecom_price_with_unit($this->resource->totalPrice()),
            'total_price_without_unit' => $this->resource->totalPrice(),
            'discount' => $this->resource->discount ?? 0,
            'discount_codes' => $this->resource->discount_codes,
            'items' => CartItemResource::collection($this->resource->getCollectionItems()),
        ];
    }
}
