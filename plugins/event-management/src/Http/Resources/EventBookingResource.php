<?php

namespace Mojahid\EventManagement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventBookingResource extends JsonResource
{
    public function toArray($request): array
    {
        $resource = [
            'id' => $this->resource->id,
            'code' => $this->resource->code,
            'status' => $this->resource->status,
            
            // Customer Info
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'phone' => $this->resource->phone,
            'address' => $this->resource->address,
            'city' => $this->resource->city,
            'state' => $this->resource->state,
            'zip' => $this->resource->zip,
            'country' => $this->resource->country,
            
            // Booking Details
            'quantity' => $this->resource->quantity,
            'total' => $this->resource->total ? ecom_price_with_unit($this->resource->total) : null,
            'booking_date' => $this->resource->booking_date ? jw_date_format($this->resource->booking_date) : null,
            'notes' => $this->resource->notes,
            
            // Status Information
            'payment_status' => $this->resource->payment_status,
            'payment_status_text' => $this->resource->payment_status_text,
            
            // Timestamps
            'created_at' => jw_date_format($this->resource->created_at),
            'updated_at' => jw_date_format($this->resource->updated_at),
        ];

        // Payment Method
        if ($this->resource->relationLoaded('paymentMethod')) {
            $resource['payment_method'] = [
                'id' => $this->resource->paymentMethod?->id,
                'name' => $this->resource->paymentMethod?->name,
                'description' => $this->resource->paymentMethod?->description,
                'type' => $this->resource->paymentMethod?->type,
            ];
        }

        // Event Information
        if ($this->resource->relationLoaded('event')) {
            $resource['event'] = [
                'id' => $this->resource->event?->id,
                'title' => $this->resource->event?->title,
                'thumbnail' => $this->resource->event?->thumbnail ? upload_url($this->resource->event?->thumbnail) : null,
                'slug' => $this->resource->event?->slug,
                'content' => $this->resource->event?->content,
                'start_date' => $this->resource->event?->getMeta('start_date') ? jw_date_format($this->resource->event?->getMeta('start_date')) : null,
                'end_date' => $this->resource->event?->getMeta('end_date') ? jw_date_format($this->resource->event?->getMeta('end_date')) : null,
                'location' => $this->resource->event?->getMeta('location'),
            ];
        }

        // Ticket Information
        if ($this->resource->relationLoaded('ticket')) {
            $resource['ticket'] = [
                'id' => $this->resource->ticket?->id,
                'name' => $this->resource->ticket?->name,
                'price' => $this->resource->ticket?->price ? ecom_price_with_unit($this->resource->ticket?->price) : null,
                'status' => $this->resource->ticket?->status,
                'quantity' => $this->resource->ticket?->quantity,
                'available' => $this->resource->ticket?->isAvailable(),
                'booked_count' => $this->resource->ticket?->getBookedCount(),
            ];
        }

        // User Information
        if ($this->resource->relationLoaded('user')) {
            $resource['user'] = [
                'id' => $this->resource->user?->id,
                'name' => $this->resource->user?->name,
                'email' => $this->resource->user?->email,
                'avatar' => $this->resource->user?->avatar ? upload_url($this->resource->user?->avatar) : null,
            ];
        }

        // Order Information
        if ($this->resource->relationLoaded('order')) {
            $resource['order'] = [
                'id' => $this->resource->order?->id,
                'code' => $this->resource->order?->code,
                'token' => $this->resource->order?->token,
                'payment_status' => $this->resource->order?->payment_status,
                'payment_status_text' => $this->resource->order?->payment_status_text,
            ];
        }

        return $resource;
    }
} 