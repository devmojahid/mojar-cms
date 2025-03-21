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
} 