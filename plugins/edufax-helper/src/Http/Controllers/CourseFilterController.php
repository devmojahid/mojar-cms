<?php

namespace Mojahid\EdufaxHelper\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Juzaweb\CMS\Http\Controllers\FrontendController;

class CourseFilterController extends FrontendController
{
    /**
     * Handle AJAX course filtering requests
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
            'paginate' => 12, // Default courses per page
            'page' => $page,
            'type' => 'courses'
        ];
        
        // Add keyword search if provided
        if (!empty($keyword)) {
            $options['keyword'] = trim($keyword);
        }
        
        // Add category filter if provided
        if (!empty($category)) {
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
        
        // Get filtered courses
        $courses = get_posts_by_filter($options);
        
        // Generate course HTML
        $coursesHtml = '';
        
        // Ensure we have data to work with
        if (!empty($courses['data'])) {
            // Build HTML for each course
            foreach ($courses['data'] as $course) {
                // Use output buffering to capture the template output
                ob_start();
                echo get_template_part($course, 'course-item');
                $coursesHtml .= ob_get_clean();
            }
        }
        
        // Generate pagination HTML
        $pagination = '';
        if (!empty($courses)) {
            ob_start();
            echo paginate_links($courses, 'theme::components.pagination');
            $pagination = ob_get_clean();
        }
        
        return response()->json([
            'status' => 'success',
            'courses_html' => $coursesHtml,
            'pagination_html' => $pagination,
            'total_courses' => $courses['total'] ?? 0,
            'current_page' => $courses['current_page'] ?? 1,
            'last_page' => $courses['last_page'] ?? 1,
        ]);
    }
    
    /**
     * Render course item HTML using template part
     *
     * @param array $course
     * @return string
     */
    protected function renderCourseItem(array $course): string
    {
        ob_start();
        echo get_template_part($course, 'course-item');
        return ob_get_clean();
    }
} 