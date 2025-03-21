<?php

namespace Mojahid\Lms\Http\Controllers\Frontend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Juzaweb\Backend\Models\Comment;
use Juzaweb\Backend\Models\Post;
use Juzaweb\Backend\Repositories\PostRepository;
use Juzaweb\CMS\Facades\HookAction;
use Juzaweb\Frontend\Http\Controllers\PostController;
use Mojahid\Lms\Http\Requests\ReviewRequest;
use Mojahid\Lms\Http\Controllers\Frontend\ReviewController;
use Mojahid\Lms\Http\Resources\CourseCollection;
use Mojahid\Lms\Http\Resources\CourseResource;
use Mojahid\Lms\Models\Course;

class CourseController extends PostController
{
    protected ReviewController $reviewController;
    
    public function __construct(protected PostRepository $postRepository)
    {
        parent::__construct($postRepository);
        $this->reviewController = app(ReviewController::class);
    }

    /**
     * Submit a review for a course
     * 
     * @param ReviewRequest $request
     * @param string $slug
     * @return JsonResponse|RedirectResponse
     */
    public function storeReview(ReviewRequest $request, $slug): JsonResponse|RedirectResponse
    {
        return $this->reviewController->review($request, $slug);
    }
    
    /**
     * Get view data for displaying a course
     * 
     * @param Post $post The course post
     * @return array
     */
    public function getCourseViewData(Post $post): array
    {
        $reviewStats = $this->reviewController->getReviewStats($post);
        $reviews = $this->reviewController->getReviews($post, 10);
        
        return [
            'post' => $post,
            'reviews' => $reviews,
            'averageRating' => $reviewStats['average'],
            'totalReviews' => $reviewStats['total'],
            'reviewStats' => [
                'counts' => $reviewStats['counts'],
                'percentages' => $reviewStats['percentages'],
            ],
        ];
    }

    /**
     * Display the learning area for a course
     * 
     * @param string $slug The course slug
     * @param string|null $lesson_slug The slug of the lesson to display
     * @return \Illuminate\View\View
     */
    
    public function learningArea($slug, $lesson_slug = null)
    {
        $post = Post::where('slug', $slug)->where('type', 'courses')->firstOrFail();
        
        // Load course with all necessary relationships
        $course = Course::with([
            'topics.lessons', 
            'orders' => function($query) {
                $query->where('user_id', auth()->id())
                      ->where('payment_status', 'completed');
            },
            'orders.paymentMethod'
        ])->where('id', $post->id)->firstOrFail();
        
        // Check if user is enrolled
        $isEnrolled = $course->orders->isNotEmpty();
        
        if (!$isEnrolled && auth()->check()) {
            return redirect()->route('profile.enrolled-courses')->with('error', 'You are not enrolled in this course.');
        }
        
        // Find current lesson
        $currentLesson = null;
        $nextLesson = null;
        $prevLesson = null;
        
        if ($course->topics->isNotEmpty()) {
            $allLessons = collect();
            
            // Collect all lessons from all topics and sort them
            foreach ($course->topics as $topic) {
                foreach ($topic->lessons as $lesson) {
                    $allLessons->push($lesson);
                }
            }
            
            $allLessons = $allLessons->sortBy([
                ['course_topic_id', 'asc'],
                ['order', 'asc']
            ]);
            
            // If lesson_slug is provided, find that lesson
            if ($lesson_slug) {
                $currentLesson = $allLessons->firstWhere('slug', $lesson_slug);
            }
            
            // If no specific lesson requested or not found, get the first lesson
            if (!$currentLesson && $allLessons->isNotEmpty()) {
                $currentLesson = $allLessons->first();
            }
            
            // Get next and previous lessons
            if ($currentLesson) {
                $currentIndex = $allLessons->search(function ($item) use ($currentLesson) {
                    return $item->id === $currentLesson->id;
                });
                
                if ($currentIndex !== false) {
                    $nextLesson = ($currentIndex < $allLessons->count() - 1) ? $allLessons[$currentIndex + 1] : null;
                    $prevLesson = ($currentIndex > 0) ? $allLessons[$currentIndex - 1] : null;
                }
            }
        }
        
        // Use an appropriate view file
        $viewFile = view()->exists('theme::course.learning-area') 
            ? 'theme::course.learning-area' 
            : 'lms::frontend.course.learning-area';
        
        return view($viewFile, [
            'page' => $post,
            'data' => [
                'course' => new CourseResource($course),
                'current_lesson' => $currentLesson,
                'next_lesson' => $nextLesson,
                'prev_lesson' => $prevLesson,
                'is_enrolled' => $isEnrolled,
                'lesson_slug' => $lesson_slug,
            ]
        ]);
    }
} 