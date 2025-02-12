<?php

namespace Mojahid\Ecommerce\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Http\Resources\OrderItemCollection;

/**
 * @property-read Order $resource
 */
class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $resource = [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'type' => $this->resource->type,
            'status' => $this->resource->status,
            'code' => $this->resource->code,
            'token' => $this->resource->token,
            
            // Customer Info
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'phone' => $this->resource->phone,
            'address' => $this->resource->address,
            'country_code' => $this->resource->country_code,
            
            // Order Details
            'quantity' => $this->resource->quantity,
            'total_price' => ecom_price_with_unit($this->resource->total_price),
            'total' => ecom_price_with_unit($this->resource->total),
            'discount' => ecom_price_with_unit($this->resource->discount),
            'discount_codes' => $this->resource->discount_codes,
            
            // Status Information
            'payment_status' => $this->resource->payment_status,
            'payment_status_text' => $this->resource->payment_status_text,
            'delivery_status' => $this->resource->delivery_status,
            'delivery_status_text' => $this->resource->delivery_status_text,
            
            // Additional Info
            'notes' => $this->resource->notes,
            'site_id' => $this->resource->site_id,
            
            // Meta Data
            'meta_data' => $this->when($this->resource->json_metas, $this->resource->json_metas),
            
            // Timestamps
            'created_at' => jw_date_format($this->resource->created_at),
            'updated_at' => jw_date_format($this->resource->updated_at),
            
            // Customer Details
            'customer' => [
                'name' => $this->resource->name,
                'email' => $this->resource->email,
                'phone' => $this->resource->phone,
                'address' => $this->resource->address,
                'country_code' => $this->resource->country_code,
            ],
        ];

        // Payment Method
        if ($this->resource->relationLoaded('paymentMethod')) {
            $resource['payment_method'] = [
                'id' => $this->resource->payment_method_id,
                'name' => $this->resource->payment_method_name,
                'description' => $this->resource->paymentMethod?->description,
            ];
        }

        // Order Items
        if ($this->resource->relationLoaded('orderItems')) {
            $resource['items'] = OrderItemCollection::make($this->resource->orderItems)->resolve();
        }

        // User Information
        if ($this->resource->relationLoaded('user')) {
            $resource['user'] = [
                'id' => $this->resource->user?->id,
                'name' => $this->resource->user?->name,
                'email' => $this->resource->user?->email,
            ];
        }

        return $resource;
    }
}
