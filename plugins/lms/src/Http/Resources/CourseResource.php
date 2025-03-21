<?php

namespace Mojahid\Lms\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request): array
    {
        $resource = [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'slug' => $this->resource->slug,
            'thumbnail' => $this->resource->thumbnail ?? upload_url($this->resource->thumbnail),
            'description' => $this->resource->description,
            'content' => $this->resource->content,
            'status' => $this->resource->status,
            'views' => $this->resource->views,
            'rating' => $this->resource->rating,
            'total_rating' => $this->resource->total_rating,
            'total_comment' => $this->resource->total_comment,
            'taxonomies' => $this->resource->taxonomies,
            // Course meta information
            'price' => $this->resource->getMeta('price') ? ecom_price_with_unit($this->resource->getMeta('price')) : null,
            'compare_price' => $this->resource->getMeta('compare_price') ? ecom_price_with_unit($this->resource->getMeta('compare_price')) : null,
            'duration' => $this->resource->getMeta('duration'),
            'difficulty_level' => $this->resource->getMeta('difficulty_level'),
            'certificate' => $this->resource->getMeta('certificate'),
            'language' => $this->resource->getMeta('language'),
            'max_students' => $this->resource->getMeta('max_students'),
            'total_enrolled' => $this->resource->getMeta('total_enrolled'),
            
            // Timestamps
            'created_at' => jw_date_format($this->resource->created_at),
            'updated_at' => jw_date_format($this->resource->updated_at),
        ];

        // Order Information (if this course was purchased)
        if ($this->resource->relationLoaded('orders')) {
            $orders = $this->resource->orders->where('type', 'courses');
            if ($orders->isNotEmpty()) {
                $order = $orders->first();
                $resource['order'] = [
                    'id' => $order->id,
                    'code' => $order->code,
                    'token' => $order->token,
                    'payment_status' => $order->payment_status,
                    'payment_status_text' => $order->payment_status_text,
                    'created_at' => jw_date_format($order->created_at),
                ];
                
                // Payment method information
                if ($order->relationLoaded('paymentMethod') && $order->paymentMethod) {
                    $resource['payment_method'] = [
                        'id' => $order->paymentMethod->id,
                        'name' => $order->paymentMethod->name,
                        'description' => $order->paymentMethod->description,
                        'type' => $order->paymentMethod->type,
                    ];
                }
            }
        }

        // Topics Information
        if ($this->resource->relationLoaded('topics')) {
            $resource['topics_count'] = $this->resource->topics->count();
            $resource['topics'] = $this->resource->topics->map(function ($topic) {
                $lessons = $topic->lessons->map(function ($lesson) {
                    return [
                        'id' => $lesson->id,
                        'title' => $lesson->title,
                        'slug' => $lesson->slug,
                        'description' => $lesson->description,
                        'thumbnail' => $lesson->thumbnail ? upload_url($lesson->thumbnail) : null,
                        'type' => $lesson->type,
                        'duration' => $lesson->duration,
                        'order' => $lesson->order,
                        'status' => $lesson->status,
                        'metas' => $lesson->metas,
                        'course_topic_id' => $lesson->course_topic_id,
                    ];
                });
                
                return [
                    'id' => $topic->id,
                    'title' => $topic->title,
                    'slug' => $topic->slug,
                    'order' => $topic->order,
                    'lessons_count' => $topic->lessons->count(),
                    'lessons' => $lessons,
                ];
            });
        }

        // Lessons Information
        if ($this->resource->relationLoaded('lessons')) {
            $resource['lessons_count'] = $this->resource->lessons->count();
        }

        return $resource;
    }
} 