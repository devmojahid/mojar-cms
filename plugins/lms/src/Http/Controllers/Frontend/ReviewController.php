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
use Juzaweb\Frontend\Http\Requests\CommentRequest;
use Mojahid\Lms\Http\Requests\ReviewRequest;

class ReviewController extends PostController
{
    public function __construct(protected PostRepository $postRepository)
    {
        parent::__construct($postRepository);
    }

    /**
     * Submit a review for a course
     * 
     * @param ReviewRequest $request
     * @param string $slug
     * @return JsonResponse|RedirectResponse
     */
    public function review(ReviewRequest $request, $slug): JsonResponse|RedirectResponse
    {
        $slug = explode('/', $slug);
        $base = Arr::get($slug, 0);


        $post = $this->postRepository->findBySlug($slug[0]);
        
        $data = $request->validated();
        $data['object_type'] = $post->type;
        $data['user_id'] = Auth::id();
        
        // Add the review-specific data to json_metas
        $jsonMetas = [
            'rating' => $request->get('rating'),
        ];
        
        // Create the comment
        $comment = $post->comments()->create($data);
        
        // Update the json_metas with the review data
        $comment->update(['json_metas' => $jsonMetas]);

        do_action('post_type.review.saved', $comment, $post);

        return $this->success(trans('lms::content.review_success'));
    }
    
    /**
     * Get the average rating for a course
     */
    public function getAverageRating($post): float
    {
        $reviews = Comment::where([
            'object_id' => $post['id'],
            'object_type' => 'courses'
        ])
        ->whereNotNull('json_metas->rating')
        ->get();
        
        if ($reviews->isEmpty()) {
            return 0;
        }
        
        $totalRating = $reviews->sum(function ($review) {
            return $review->getRating();
        });
        
        return $reviews->count() > 0 ? round($totalRating / $reviews->count(), 1) : 0;
    }
    
    /**
     * Get reviews for a course with pagination
     */
    public function getReviews($post, int $perPage = 10)
    {
        return Comment::with(['user'])
            ->where([
                'object_id' => $post['id'],
                'object_type' => 'courses'
            ])
            ->whereNotNull('json_metas->rating')
            ->whereApproved()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
    
    /**
     * Get review statistics for a course
     */
    public function getReviewStats($post): array
    {
        $reviews = Comment::where([
            'object_id' => $post['id'],
            'object_type' => 'courses'
        ])
        ->whereNotNull('json_metas->rating')
        ->whereApproved()
        ->get();
        
        $totalReviews = $reviews->count();
        $averageRating = $this->getAverageRating($post);
        
        // Count reviews by rating
        $ratingCounts = [
            5 => 0,
            4 => 0,
            3 => 0,
            2 => 0,
            1 => 0
        ];
        
        foreach ($reviews as $review) {
            $rating = (int) $review->getRating();
            if (isset($ratingCounts[$rating])) {
                $ratingCounts[$rating]++;
            }
        }
        
        return [
            'total' => $totalReviews,
            'average' => $averageRating,
            'counts' => $ratingCounts,
            'percentages' => [
                5 => $totalReviews > 0 ? ($ratingCounts[5] / $totalReviews) * 100 : 0,
                4 => $totalReviews > 0 ? ($ratingCounts[4] / $totalReviews) * 100 : 0,
                3 => $totalReviews > 0 ? ($ratingCounts[3] / $totalReviews) * 100 : 0,
                2 => $totalReviews > 0 ? ($ratingCounts[2] / $totalReviews) * 100 : 0,
                1 => $totalReviews > 0 ? ($ratingCounts[1] / $totalReviews) * 100 : 0,
            ]
        ];
    }
} 