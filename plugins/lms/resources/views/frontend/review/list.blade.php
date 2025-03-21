{{-- <div class="course-reviews mb-5">
    <h3 class="section-title mb-4">{{ trans('lms::content.reviews') }} ({{ $totalReviews }})</h3>
    
    @if($averageRating > 0)
    <div class="reviews-summary card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="average-rating-box">
                        <div class="average-score display-4 fw-bold">{{ number_format($averageRating, 1) }}</div>
                        <div class="rating-stars d-flex justify-content-center my-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $averageRating)
                                    <span class="rating-star active">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-filled icon-tabler-star-filled">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" stroke-width="0" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                @elseif($i <= $averageRating + 0.5 && $i > $averageRating)
                                    <span class="rating-star half">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-filled icon-tabler-star-half-filled">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 1a.993 .993 0 0 1 .823 .443l.067 .116l2.852 5.781l6.38 .925c.741 .108 1.08 .94 .703 1.526l-.07 .095l-.078 .086l-4.624 4.499l1.09 6.355a1.001 1.001 0 0 1 -1.249 1.135l-.101 -.035l-.101 -.046l-5.693 -3l-5.706 3c-.105 .055 -.212 .09 -.32 .106l-.106 .01a1.003 1.003 0 0 1 -1.038 -1.06l.013 -.11l1.09 -6.355l-4.623 -4.5a1.001 1.001 0 0 1 .328 -1.647l.113 -.036l.114 -.023l6.379 -.925l2.853 -5.78a.968 .968 0 0 1 .904 -.559zm0 3.274v12.476a1 1 0 0 1 .239 .029l.115 .036l.112 .05l4.363 2.299l-.836 -4.873a1 1 0 0 1 .278 -.904l.07 -.066l.09 -.07l3.547 -3.447l-4.889 -.708a1 1 0 0 1 -.776 -.692l-.032 -.099l-.021 -.103l-2.18 -4.428z" stroke-width="0" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                @else
                                    <span class="rating-star">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-star">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>
                                        </svg>
                                    </span>
                                @endif
                            @endfor
                        </div>
                        <div class="text-muted">{{ trans('lms::content.total_reviews') }}: {{ $totalReviews }}</div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="rating-breakdown">
                        <h5>{{ trans('lms::content.star_ratings') }}</h5>
                        @foreach($reviewStats['counts'] as $rating => $count)
                            <div class="rating-progress-bar d-flex align-items-center mb-2">
                                <div class="rating-label me-2">{{ $rating }} {{ trans('lms::content.star') }}</div>
                                <div class="progress flex-grow-1">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $reviewStats['percentages'][$rating] }}%" aria-valuenow="{{ $reviewStats['percentages'][$rating] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="ms-2">{{ $count }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($reviews->count() > 0)
        <div class="review-list">
            @foreach($reviews as $review)
                <div class="review-item card mb-3">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="review-avatar me-3">
                                <img src="{{ $review->getAvatar() }}" alt="{{ $review->getUserName() }}" class="rounded-circle" width="50" height="50">
                            </div>
                            <div class="review-content flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="reviewer-name mb-0">{{ $review->getUserName() }}</h5>
                                    <div class="review-date text-muted small">{{ $review->getCreatedDate() }}</div>
                                </div>
                                <div class="rating-stars mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->getRating())
                                            <span class="rating-star active">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-filled icon-tabler-star-filled">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" stroke-width="0" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        @else
                                            <span class="rating-star">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-star">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>
                                                </svg>
                                            </span>
                                        @endif
                                    @endfor
                                </div>
                                <div class="review-text">
                                    {{ $review->content }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="review-pagination mt-4">
            {{ $reviews->links() }}
        </div>
    @else
        <div class="no-reviews text-center p-4 bg-light rounded">
            <div class="mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-message-circle">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M3 20l1.3 -3.9c-2.324 -3.437 -1.426 -7.872 2.1 -10.374c3.526 -2.501 8.59 -2.296 11.845 .48c3.255 2.777 3.695 7.266 1.029 10.501c-2.666 3.235 -7.615 4.215 -11.574 2.293l-4.7 1"></path>
                </svg>
            </div>
            <h5>{{ trans('lms::content.no_reviews') }} blade</h5>
            <p class="text-muted">{{ trans('lms::content.be_first_review') }}</p>
        </div>
    @endif

</div>

@auth
    @include('lms::frontend.review.form', ['post' => $post])
@else
    <div class="login-to-review alert alert-info">
        <p>{{ trans('lms::content.login_to_review') }}</p>
        <a href="{{ route('login') }}" class="btn btn-primary">{{ trans('cms::app.login') }}</a>
    </div>
@endauth  --}}