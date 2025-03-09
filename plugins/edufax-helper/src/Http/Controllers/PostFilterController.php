<?php

namespace Mojahid\EdufaxHelper\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Juzaweb\CMS\Http\Controllers\FrontendController;

class PostFilterController extends FrontendController
{
    /**
     * Handle AJAX post filtering requests
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function filter(Request $request): JsonResponse
    {
        $keyword = $request->input('keyword');
        $category = $request->input('category');
        $page = $request->input('page', 1);
        $sort = $request->input('sort', 'latest');
        
        $options = [
            'paginate' => 12, // Default posts per page
            'page' => $page,
            'type' => 'posts'
        ];
        
        // Add keyword search if provided
        if (!empty($keyword)) {
            // Ensure exact keyword matching by properly setting
            $options['keyword'] = trim($keyword);
        }
        
        // Add category filter if provided
        if (!empty($category)) {
            // Fix: Correctly set up taxonomy filtering for the JWQuery system
            $options['taxonomies'] = [
                'categories' => [(int)$category]
            ];
        }
        
        // Add sorting options
        switch ($sort) {
            case 'oldest':
                $options['order_by'] = ['created_at' => 'asc'];
                break;
            case 'a-z':
                $options['order_by'] = ['title' => 'asc'];
                break;
            case 'z-a':
                $options['order_by'] = ['title' => 'desc'];
                break;
            case 'popular':
                $options['order_by'] = ['views' => 'desc'];
                break;
            case 'latest':
            default:
                $options['order_by'] = ['created_at' => 'desc'];
                break;
        }
        
        // Get filtered posts
        $posts = get_posts_by_filter($options);
        
        // Generate post HTML - Debug what's in the posts array
        $postsHtml = '';
        
        // Ensure we have data to work with
        if (!empty($posts['data'])) {
            // Build HTML for each post
            foreach ($posts['data'] as $post) {
                // Use output buffering to capture the template output
                ob_start();
                echo get_template_part($post, 'content');
                $postsHtml .= ob_get_clean();
            }
        }
        
        // Generate pagination HTML
        $pagination = '';
        if (!empty($posts)) {
            ob_start();
            echo paginate_links($posts, 'theme::components.pagination');
            $pagination = ob_get_clean();
        }
        
        return response()->json([
            'status' => 'success',
            'posts_html' => $postsHtml,
            'pagination_html' => $pagination,
            'total_posts' => $posts['total'] ?? 0,
            'current_page' => $posts['current_page'] ?? 1,
            'last_page' => $posts['last_page'] ?? 1,
        ]);
    }
    
    /**
     * Render post item HTML using template part
     *
     * @param array $post
     * @return string
     */
    protected function renderPostItem(array $post): string
    {
        ob_start();
        echo get_template_part($post, 'content');
        return ob_get_clean();
    }
} 