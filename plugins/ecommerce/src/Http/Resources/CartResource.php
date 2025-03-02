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
            'total_price_without_discount' => ecom_price_with_unit($this->resource->totalPrice() - $this->resource->getDiscount()),
            'total_discount' => ecom_price_with_unit($this->resource->getDiscount()),
            'subtotal' => ecom_price_with_unit($this->resource->totalPrice()),
            'subtotal_without_discount' => ecom_price_with_unit($this->resource->totalPrice() - $this->resource->getDiscount()),
            'subtotal_discount' => ecom_price_with_unit($this->resource->getDiscount()),
            // 'pricing' => [
            //     'subtotal' => $this->resource->totalPrice(),
            //     'subtotal_formatted' => ecom_price_with_unit($this->resource->totalPrice()),
            //     'discount' => $this->resource->getDiscount(),
            //     'discount_formatted' => ecom_price_with_unit($this->resource->getDiscount()),
            //     'total' => $this->resource->totalPrice() - $this->resource->getDiscount(),
            //     'total_formatted' => ecom_price_with_unit($this->resource->totalPrice() - $this->resource->getDiscount()),
            // ],
            // 'discounts' => [
            //     'applied_codes' => $this->resource->getDiscountCodes(),
            //     'total_savings' => $this->resource->getDiscount(),
            // ],
            'items' => CartItemResource::collection($this->resource->getCollectionItems()),
        ];
    }
}
