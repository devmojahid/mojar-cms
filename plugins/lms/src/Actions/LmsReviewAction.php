<?php

namespace Mojahid\Lms\Actions;

use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Juzaweb\Backend\Models\Comment;
use Plugins\LMS\Http\Controllers\Frontend\ReviewController;

class LmsReviewAction extends Action
{
    public function handle(): void
    {
        // Register route for submitting reviews
        $this->addAction(Action::FRONTEND_INIT, [$this, 'registerFrontendRoutes']);
        
        // Add hook to display reviews in single course template
        $this->addAction('frontend.post_type.courses.detail.data', [$this, 'addReviewData'], 10, 2);
        
        // Add review filters
        $this->addFilter('comment.statuses', [$this, 'registerCommentStatuses']);
        
        // Register admin datatable filters
        $this->addFilter('admin.comment.datatable', [$this, 'modifyCommentDatatable']);
    }

    public function registerFrontendRoutes(): void
    {
        //
    }

    /**
     * Add review data to the course detail page
     * 
     * @param array $data
     * @param \Juzaweb\Backend\Models\Post $post
     * @return array
     */
    public function addReviewData(array $data, $post): array
    {
        $reviewController = app(ReviewController::class);
        
        // Get reviews for this course
        $reviews = $reviewController->getReviews($post);
        
        // Get review statistics
        $reviewStats = $reviewController->getReviewStats($post);
        
        // Add review data to the view data
        $data['reviews'] = $reviews;
        $data['reviewStats'] = $reviewStats;
        $data['averageRating'] = $reviewStats['average'];
        $data['totalReviews'] = $reviewStats['total'];
        
        return $data;
    }
    
    /**
     * Register additional comment statuses for reviews
     * 
     * @param array $statuses
     * @return array
     */
    public function registerCommentStatuses(array $statuses): array
    {
        // We're just using the existing comment statuses
        // You could add review-specific statuses here if needed
        return $statuses;
    }
    
    /**
     * Modify the comment datatable to show review-specific information
     * 
     * @param array $table
     * @return array
     */
    public function modifyCommentDatatable(array $table): array
    {
        // Add rating column to comment datatable
        $table['columns']['rating'] = [
            'label' => trans('lms::content.rating'),
            'width' => '10%',
            'formatter' => function ($value, $row, $index) {
                if ($row->isReview()) {
                    return view('lms::backend.review.rating', [
                        'rating' => $row->getRating(),
                    ])->render();
                }
                
                return '';
            },
        ];
        
        // Add filter to show only reviews
        $table['filters']['reviews'] = [
            'label' => trans('lms::content.reviews'),
            'callback' => function ($query) {
                return $query->whereNotNull('json_metas->rating');
            }
        ];
        
        return $table;
    }
} 