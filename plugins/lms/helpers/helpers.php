<?php

use Mojahid\Lms\Http\Controllers\Frontend\ReviewController;
use Mojahid\Ecommerce\Models\Order;

function lms_get_reviews($post, $perPage = 10)
{
    $reviewController = app(ReviewController::class);
    return $reviewController->getReviews($post, $perPage);
}


function lms_get_average_rating($post)
{
    $reviewController = app(ReviewController::class);
    return $reviewController->getAverageRating($post);
}


function lms_get_review_stats($post)
{
    $reviewController = app(ReviewController::class);
    return $reviewController->getReviewStats($post);
}

/**
 * Get the total lesson count for a course
 * 
 * @param \Juzaweb\Backend\Models\Post|array $post Course post
 * @return int Lesson count
 */
function lms_get_lesson_count($post)
{
    if (empty($post)) {
        return 0;
    }
    
    try {
        // Extract post ID based on whether $post is an object or array
        $postId = is_array($post) ? ($post['id'] ?? 0) : $post->id;
        
        if (empty($postId)) {
            return 0;
        }
        
        // Try to get from cache first to avoid repeated DB queries
        $cacheKey = 'lms_lesson_count_' . $postId;
        $cache = app('cache');
        
        if ($cache->has($cacheKey)) {
            return (int) $cache->get($cacheKey);
        }
        
        $lessonCount = 0;
        
        // If we have metas with total_lessons, use that first
        if (is_array($post) && isset($post['metas']['total_lessons']) && is_numeric($post['metas']['total_lessons'])) {
            $lessonCount = (int) $post['metas']['total_lessons'];
        } elseif (is_object($post) && isset($post->metas['total_lessons']) && is_numeric($post->metas['total_lessons'])) {
            $lessonCount = (int) $post->metas['total_lessons'];
        }
        
        if ($lessonCount > 0) {
            $cache->put($cacheKey, $lessonCount, now()->addHours(1));
            return $lessonCount;
        }
        
        // Get course model
        $course = app(\Mojahid\Lms\Models\Course::class)->find($postId);
        if ($course) {
            // Get lesson count using relationship
            $lessonCount = $course->lessons()->count();
            if ($lessonCount > 0) {
                $cache->put($cacheKey, $lessonCount, now()->addHours(1));
                return $lessonCount;
            }
        }
        
        // Fallback: Check if we can count directly from the lessons table
        try {
            $db = app('db');
            
            // Get the prefix used for the tables
            $prefix = config('database.connections.mysql.prefix', '');
            $lessonsTable = $prefix . 'lms_course_lessons';
            $topicsTable = $prefix . 'lms_course_topics';
            $postsTable = $prefix . 'posts';
            
            $hasLessonsTable = $db->getSchemaBuilder()->hasTable('lms_course_lessons') || 
                               $db->getSchemaBuilder()->hasTable($lessonsTable);
            $hasTopicsTable = $db->getSchemaBuilder()->hasTable('lms_course_topics') || 
                              $db->getSchemaBuilder()->hasTable($topicsTable);
            
            if ($hasLessonsTable) {
                if ($hasTopicsTable) {
                    // First check if the lesson is connected to topics for this course
                    $lessonCount = $db->table($lessonsTable)
                        ->join($topicsTable, $lessonsTable . '.course_topic_id', '=', $topicsTable . '.id')
                        ->where($topicsTable . '.post_id', $postId)
                        ->count();
                    
                    if ($lessonCount > 0) {
                        $cache->put($cacheKey, $lessonCount, now()->addHours(1));
                        return $lessonCount;
                    }
                }
                
                // Check direct post_id link to course
                $lessonCount = $db->table($lessonsTable)
                    ->where('post_id', $postId)
                    ->count();
                    
                if ($lessonCount > 0) {
                    $cache->put($cacheKey, $lessonCount, now()->addHours(1));
                    return $lessonCount;
                }
            }
            
            // Check for posts with type 'lms_course_lesson' and meta relation to this course
            if ($db->getSchemaBuilder()->hasTable('posts') || $db->getSchemaBuilder()->hasTable($postsTable)) {
                // Check for post_metas that link lessons to this course
                $postMetasTable = $prefix . 'post_metas';
                
                if ($db->getSchemaBuilder()->hasTable('post_metas') || $db->getSchemaBuilder()->hasTable($postMetasTable)) {
                    $lessonCount = $db->table($postsTable)
                        ->join($postMetasTable, $postsTable . '.id', '=', $postMetasTable . '.post_id')
                        ->where($postsTable . '.type', 'lms_course_lesson')
                        ->where(function($query) use ($postMetasTable, $postId) {
                            $query->where($postMetasTable . '.meta_key', 'course_id')
                                  ->where($postMetasTable . '.meta_value', $postId);
                        })
                        ->count();
                        
                    if ($lessonCount > 0) {
                        $cache->put($cacheKey, $lessonCount, now()->addHours(1));
                        return $lessonCount;
                    }
                }
                
                // Check for json_metas.course_id reference for newer Laravel versions
                $lessonCount = $db->table($postsTable)
                    ->where('type', 'lms_course_lesson')
                    ->whereRaw("JSON_EXTRACT(json_metas, '$.course_id') = ?", [$postId])
                    ->count();
                    
                if ($lessonCount > 0) {
                    $cache->put($cacheKey, $lessonCount, now()->addHours(1));
                    return $lessonCount;
                }
            }
        } catch (\Exception $e) {
            \Log::error('Error in SQL query for counting lessons: ' . $e->getMessage(), [
                'post_id' => $postId,
                'trace' => $e->getTraceAsString()
            ]);
        }
        
        // Cache the zero result too to avoid repeated queries
        $cache->put($cacheKey, 0, now()->addMinutes(15));
        return 0;
    } catch (\Exception $e) {
        \Log::error('Error counting lessons: ' . $e->getMessage(), [
            'post' => is_array($post) ? json_encode($post) : (is_object($post) ? $post->id : 'invalid post'),
            'trace' => $e->getTraceAsString()
        ]);
        return 0;
    }
}

/**
 * Get the total student count for a course
 * 
 * @param \Juzaweb\Backend\Models\Post|array $post Course post
 * @return int Student count
 */
function lms_get_student_count($post)
{
    if (empty($post)) {
        return 0;
    }
    
    try {
        $postId = is_array($post) ? ($post['id'] ?? 0) : $post->id;
        
        if (empty($postId)) {
            return 0;
        }
        
        $cacheKey = 'lms_student_count_' . $postId;
        $cache = app('cache');
        
        if ($cache->has($cacheKey)) {
            return (int) $cache->get($cacheKey);
        }
        
        $studentCount = 0;
        
        // Check metas first
        if (is_array($post) && isset($post['metas']['total_enrolled']) && is_numeric($post['metas']['total_enrolled'])) {
            $studentCount = (int) $post['metas']['total_enrolled'];
        } elseif (is_object($post) && isset($post->metas['total_enrolled']) && is_numeric($post->metas['total_enrolled'])) {
            $studentCount = (int) $post->metas['total_enrolled'];
        }
        
        if ($studentCount > 0) {
            $cache->put($cacheKey, $studentCount, now()->addHours(1));
            return $studentCount;
        }
        
        // Optimized Eloquent query using relationships
        $course = app(\Mojahid\Lms\Models\Course::class)->find($postId);
        if ($course) {
            $studentCount = $course->orders()
                ->where('payment_status', Order::PAYMENT_STATUS_COMPLETED)
                ->distinct('user_id')
                ->count('user_id');
            
            if ($studentCount > 0) {
                $cache->put($cacheKey, $studentCount, now()->addHours(1));
                return $studentCount;
            }
        }
        
        // Fallback to raw query if Eloquent fails
        try {
            $db = app('db');
            $prefix = config('database.connections.mysql.prefix', '');
            $orderItemsTable = $prefix . 'order_items';
            $ordersTable = $prefix . 'orders';
            
            $studentCount = $db->table($orderItemsTable)
                ->join($ordersTable, "$orderItemsTable.order_id", '=', "$ordersTable.id")
                ->where("$orderItemsTable.post_id", $postId)
                ->where("$orderItemsTable.type", 'courses')
                ->where("$ordersTable.payment_status", Order::PAYMENT_STATUS_COMPLETED)
                ->whereNotNull("$ordersTable.user_id")
                ->selectRaw('COUNT(DISTINCT ' . $db->getSchemaGrammar()->wrap("$ordersTable.user_id") . ') as user_count')
                ->value('user_count') ?? 0;
                
            $cache->put($cacheKey, $studentCount, now()->addHours(1));
            return $studentCount;
        } catch (\Exception $e) {
            \Log::error('Error in student count query: ' . $e->getMessage());
        }
        
        $cache->put($cacheKey, 0, now()->addMinutes(15));
        return 0;
    } catch (\Exception $e) {
        \Log::error('Error counting students: ' . $e->getMessage());
        return 0;
    }
}