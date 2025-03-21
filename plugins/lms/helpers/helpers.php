<?php

use Mojahid\Lms\Http\Controllers\Frontend\ReviewController;

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