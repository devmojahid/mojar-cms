<?php

namespace Mojahid\Ecommerce\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderItemCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return $this->collection->map(
            function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'type' => $item->type,
                    
                    // Pricing
                    'price' => ecom_price_with_unit($item->price),
                    'line_price' => ecom_price_with_unit($item->line_price),
                    'compare_price' => ecom_price_with_unit($item->compare_price),
                    'quantity' => $item->quantity,
                    
                    // Product Info
                    'thumbnail' => upload_url($item->thumbnail),
                    'sku_code' => $item->sku_code,
                    'barcode' => $item->barcode,
                    
                    // Relationships
                    'order_id' => $item->order_id,
                    'post_id' => $item->post_id,
                    
                    // Meta Data
                    'meta_data' => $item->json_metas ?? [],
                    
                    // Post Details (if loaded)
                    // 'post' => $item->whenLoaded('post', function() use ($item) {
                    //     return [
                    //         'id' => $item->post->id,
                    //         'title' => $item->post->title,
                    //         'type' => $item->post->type,
                    //         'thumbnail' => $item->post->thumbnail,
                    //     ];
                    // }),
                    
                    // Timestamps
                    'created_at' => jw_date_format($item->created_at),
                    'updated_at' => jw_date_format($item->updated_at),
                ];
            }
        )->toArray();
    }
}
