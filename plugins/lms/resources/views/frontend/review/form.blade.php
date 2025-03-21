{{-- <div class="course-review-form card mb-4">
    <div class="card-header d-flex align-items-center">
        <h5 class="card-title mb-0">{{ trans('lms::content.write_review') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('lms.courses.review', ['slug' => $post->slug]) }}" method="post" class="review-form">
            @csrf
            <div class="mb-3 rating-selection">
                <label class="form-label">{{ trans('lms::content.your_rating') }} <span class="text-danger">*</span></label>
                <div class="rating-stars">
                    <div class="d-flex">
                        @for($i = 5; $i >= 1; $i--)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating{{ $i }}" value="{{ $i }}" required>
                                <label class="form-check-label" for="rating{{ $i }}">
                                    <div class="star-rating">
                                        @for($j = 1; $j <= 5; $j++)
                                            @if($j <= $i)
                                                <span class="rating-star active">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-filled icon-tabler-star-filled">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" stroke-width="0" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                            @else
                                                <span class="rating-star">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-star">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>
                                                    </svg>
                                                </span>
                                            @endif
                                        @endfor
                                    </div>
                                </label>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">{{ trans('cms::app.content') }} <span class="text-danger">*</span></label>
                <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
            </div>

            @guest
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">{{ trans('cms::app.name') }} <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">{{ trans('cms::app.email') }} <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="website" class="form-label">{{ trans('cms::app.website') }}</label>
                        <input type="url" name="website" id="website" class="form-control">
                    </div>
                </div>
            @endguest

            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ trans('lms::content.submit_review') }}</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.review-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        JuzaWeb.showSuccessMessage(response.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        JuzaWeb.showErrorMessage(response.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        JuzaWeb.showErrorMessage(xhr.responseJSON.message);
                    } else {
                        JuzaWeb.showErrorMessage('An error occurred. Please try again.');
                    }
                }
            });
        });
    });
</script>  --}}