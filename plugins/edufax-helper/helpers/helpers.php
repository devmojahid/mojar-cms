<?php

use Illuminate\Support\Arr;

if (!function_exists('edufax_helper_filter_posts')) {
    /**
     * Get filtered posts based on criteria
     *
     * @param array $criteria
     * @return array
     */
    function edufax_helper_filter_posts(array $criteria): array
    {
        $postType = Arr::get($criteria, 'type', 'posts');
        $keyword = Arr::get($criteria, 'keyword');
        $taxonomy = Arr::get($criteria, 'taxonomy');
        $taxonomyId = Arr::get($criteria, 'taxonomy_id');
        $orderBy = Arr::get($criteria, 'order_by', ['created_at' => 'desc']);
        
        $options = [
            'paginate' => Arr::get($criteria, 'paginate', 12),
            'page' => Arr::get($criteria, 'page', 1),
            'order_by' => $orderBy,
        ];
        
        if (!empty($keyword)) {
            $options['keyword'] = $keyword;
        }
        
        if (!empty($taxonomy) && !empty($taxonomyId)) {
            $options['taxonomy'] = $taxonomy;
            $options['taxonomy_id'] = $taxonomyId;
        }
        
        return get_posts($postType, $options);
    }
}

if (!function_exists('edufax_helper_is_filtering')) {
    /**
     * Check if current request is filtering posts
     *
     * @return bool
     */
    function edufax_helper_is_filtering(): bool
    {
        return request()->has('keyword') || request()->has('category') || request()->has('sort');
    }
} 