<?php

namespace Mojahid\EdufaxHelper\Actions;

use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Juzaweb\CMS\Version;
use Twig\TwigFunction;

class EdufaxHelperAction extends Action
{
    /**
     * Handle all the actions and filters for the theme helper.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->addAction(Action::INIT_ACTION, [$this, 'registerAjaxRoutes']);
    }

    /**
     * Register frontend assets for the plugin.
     *
     * @return void
     */
    public function registerFrontendAssets(): void
    {
        HookAction::enqueueScript('edufax-helper-scripts', plugin_asset('edufax-helper', 'js/post-filter.js'), $ver);
        HookAction::enqueueStyle('edufax-helper-styles', plugin_asset('edufax-helper', 'css/post-filter.css'), $ver);
    }

    /**
     * Register custom AJAX routes used by the theme.
     *
     * @return void
     */
    public function registerAjaxRoutes(): void
    {
        // AJAX route registration can be done in the routes/web.php file
        // This method can be used for any additional route setup if needed
    }
    
    /**
     * Get dashboard statistics for user profile
     * This method is made public so it can be called from the helper function
     *
     * @return array
     */
    public function getDashboardStats(): array
    {
        $userId = auth()?->user()?->id;
        if (!$userId) {
            return [
                'enrolled_courses' => 0,
                'active_courses' => 0,
                'completed_courses' => 0,
                'total_students' => 0,
                'total_courses' => 0,
                'total_earnings' => 0,
            ];
        }

        // Get ecommerce stats
        $totalEarnings = 0;
        $orderCount = 0;
        try {
            // Check if ecommerce plugin is active
            if (class_exists('\Mojahid\Ecommerce\Models\Order')) {
                // Get orders for current user
                $orders = \Mojahid\Ecommerce\Models\Order::where('user_id', $userId)->get();
                $orderCount = $orders->count();
                
                // Calculate total earnings
                $totalEarnings = $orders->where('payment_status', 'completed')->sum('total');
            }
        } catch (\Exception $e) {
            \Log::error('Error getting ecommerce stats: ' . $e->getMessage());
        }

        // Get LMS stats
        $enrolledCourses = 0;
        $activeCourses = 0;
        $completedCourses = 0;
        $totalStudents = 0;
        $totalCourses = 0;
        
        try {
            // Check if LMS plugin is active and classes exist
            if (class_exists('\Mojahid\Lms\Models\Course')) {
                // Get course stats
                $courses = \Mojahid\Lms\Models\Course::query()
                    ->where('type', 'courses')
                    ->whereHas('orderItems', function ($query) use ($userId) {
                        $query->where('type', 'courses')
                            ->whereHas('order', function($subQuery) use ($userId) {
                                $subQuery->where('user_id', $userId)
                                    ->where('payment_status', 'completed');
                            });
                    })
                    ->get();
                
                $enrolledCourses = $courses->count();
                
                // Get active and completed courses
                if (class_exists('\Mojahid\Lms\Models\UserCourseProgress')) {
                    $activeCourses = \Mojahid\Lms\Models\UserCourseProgress::where('user_id', $userId)
                        ->where('progress', '<', 100)
                        ->count();
                        
                    $completedCourses = \Mojahid\Lms\Models\UserCourseProgress::where('user_id', $userId)
                        ->where('progress', 100)
                        ->count();
                }
                
                // Get total students and courses if user is instructor
                $isInstructor = auth()?->user()?->hasPermission('instructor');
                if ($isInstructor) {
                    $totalCourses = \Mojahid\Lms\Models\Course::where('author_id', $userId)->count();
                    
                    $totalStudents = \Mojahid\Lms\Models\Course::where('author_id', $userId)
                        ->whereHas('orderItems', function ($query) {
                            $query->whereHas('order', function($subQuery) {
                                $subQuery->where('payment_status', 'completed');
                            });
                        })
                        ->count('DISTINCT order_items.user_id');
                }
            }
        } catch (\Exception $e) {
            \Log::error('Error getting LMS stats: ' . $e->getMessage());
        }

        return [
            'enrolled_courses' => $enrolledCourses,
            'active_courses' => $activeCourses,
            'completed_courses' => $completedCourses,
            'total_students' => $totalStudents,
            'total_courses' => $totalCourses,
            'total_earnings' => $totalEarnings,
            'total_orders' => $orderCount,
        ];
    }
    
    /**
     * Get user's recent orders
     * This method is made public so it can be called from the helper function
     *
     * @param int $limit
     * @return array
     */
    public function getRecentOrders(int $limit = 5): array
    {
        $userId = auth()?->user()?->id;
        if (!$userId) {
            return [];
        }

        try {
            // Check if ecommerce plugin is active
            if (!class_exists('\Mojahid\Ecommerce\Models\Order')) {
                return [];
            }
            
            $orders = \Mojahid\Ecommerce\Models\Order::with(['paymentMethod'])
                ->where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get();

            return $orders->map(function($order) {
                return [
                    'id' => $order->id,
                    'code' => $order->code,
                    'created_at' => $order->created_at,
                    'payment_status' => $order->payment_status,
                    'payment_method' => $order->paymentMethod?->name,
                    'total' => $order->total,
                ];
            })->toArray();
        } catch (\Exception $e) {
            \Log::error('Error getting recent orders: ' . $e->getMessage());
            return [];
        }
    }
} 