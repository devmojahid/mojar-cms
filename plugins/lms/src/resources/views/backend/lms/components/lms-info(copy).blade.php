@php
    /**
     * @var \Juzaweb\Backend\Models\Post $model
     * @var \Juzaweb\merce\Models\Producttopic $topic
     */

    $topic = $model;
@endphp

<style>
    .form-imagecheck-input[type=radio]:checked~.form-imagecheck-figure:before {
        display: none;
    }

    .form-imagecheck-input[type=radio]~.form-imagecheck-figure:before {
        display: none;
    }

    /* Curriculum Section Styles */
    .curriculum-empty-state {
        text-align: center;
        padding: 3rem 1rem;
        background-color: rgba(var(--tblr-light-rgb), .7);
        border-radius: 8px;
        margin: 1.5rem 0;
    }

    .curriculum-empty-state svg {
        width: 80px;
        height: 80px;
        color: var(--tblr-primary);
        margin-bottom: 1rem;
    }

    .curriculum-container {
        margin-top: 1.5rem;
    }

    .curriculum-topic {
        background-color: var(--tblr-light);
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .curriculum-topic-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background-color: rgba(var(--tblr-primary-rgb), .05);
        border-radius: 0.5rem 0.5rem 0 0;
        cursor: move;
    }

    .curriculum-topic-title {
        font-weight: 600;
        font-size: 1rem;
        margin: 0;
    }

    .curriculum-topic-actions {
        display: flex;
        gap: 0.5rem;
    }

    .curriculum-items {
        padding: 0.5rem 1rem;
    }

    .curriculum-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.7rem;
        margin: 0.5rem 0;
        background-color: #fff;
        border-radius: 0.3rem;
        border-left: 3px solid var(--tblr-primary);
        cursor: move;
    }

    .curriculum-item-type {
        display: inline-flex;
        align-items: center;
        padding: 0.2rem 0.5rem;
        font-size: 0.75rem;
        border-radius: 1rem;
        background-color: rgba(var(--tblr-primary-rgb), .1);
        color: var(--tblr-primary);
        margin-right: 0.5rem;
    }

    .curriculum-item-video {
        border-left-color: var(--tblr-primary);
    }

    .curriculum-item-document {
        border-left-color: var(--tblr-indigo);
    }

    .curriculum-item-quiz {
        border-left-color: var(--tblr-orange);
    }

    .curriculum-item-assignment {
        border-left-color: var(--tblr-green);
    }

    .curriculum-item.curriculum-item-quiz .curriculum-item-type {
        background-color: rgba(var(--tblr-orange-rgb), .1);
        color: var(--tblr-orange);
    }

    .curriculum-item.curriculum-item-assignment .curriculum-item-type {
        background-color: rgba(var(--tblr-green-rgb), .1);
        color: var(--tblr-green);
    }

    .curriculum-item-title {
        flex-grow: 1;
        margin-left: 0.5rem;
    }

    .curriculum-item-duration {
        font-size: 0.8rem;
        color: var(--tblr-secondary);
        margin-right: 0.5rem;
    }

    .curriculum-add-item {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.7rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .curriculum-topic-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .curriculum-topic-actions {
            width: 100%;
            justify-content: flex-end;
        }
        
        .curriculum-item {
            flex-wrap: wrap;
        }
        
        .curriculum-item-actions {
            width: 100%;
            justify-content: flex-end;
            margin-top: 0.5rem;
        }
    }
</style>


<div class="card mt-3 mb-3">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
            <li class="nav-item">
                <a href="#tabs-product-info" class="nav-link active" data-bs-toggle="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-check">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" />
                        <path d="M16 3v4" />
                        <path d="M8 3v4" />
                        <path d="M4 11h16" />
                        <path d="M15 19l2 2l4 -4" />
                    </svg>
                    {{ __('Course Info') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="#tabs-curriculum" class="nav-link" data-bs-toggle="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="7" r="4" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                    {{ __('Curriculum') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="#tabs-media-area" class="nav-link" data-bs-toggle="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                        <path d="M9 17h6" />
                    </svg>
                    {{ __('Resources') }}
                </a>
            </li>
        </ul>

    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active show" id="tabs-product-info">
                {{-- pricing model free or paid --}}
                <div>
                    <div class="mb-3">
                        <label class="form-label">
                            {{ __('Pricing Model') }}
                        </label>
                        <div class="row">
                            <div class="col-6 col-sm-4 row">
                                <div class="col-6 col-sm-4">
                                    <label class="form-imagecheck mb-2">
                                        <input name="form-imagecheck-radio" type="radio" value="1"
                                            class="form-imagecheck-input" checked />
                                        <span class="form-selectgroup-label form-imagecheck-figure">
                                            {{ __('Free') }}
                                        </span>
                                    </label>
                                </div>
                                <div class="col-6 col-sm-4">
                                    <label class="form-imagecheck mb-2">
                                        <input name="form-imagecheck-radio" type="radio" value="2"
                                            class="form-imagecheck-input" />
                                        <span class="form-selectgroup-label form-imagecheck-figure">
                                            {{ __('Paid') }}
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-sm-4">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="paid-price-box">
                    <div class="row">
                        <div class="col-md-6">
                            {{ Field::text(trans('lms::content.price'), 'meta[price]', [
                                'value' => $topic->price ? number_format($topic->price) : '',
                                'class' => 'is-number number-format',
                                'prefix' => '$',
                            ]) }}

                        </div>

                        <div class="col-md-6">
                            {{ Field::text(trans('lms::content.compare_price'), 'meta[compare_price]', [
                                'value' => $topic->compare_price ? number_format($topic->compare_price) : '',
                                'class' => 'is-number number-format',
                                'prefix' => '$',
                            ]) }}
                        </div>
                    </div>
                </div>

                <div>
                    <div class="row">
                        <div class="col-md-6">
                            {{ Field::text(trans('lms::content.max_students'), 'meta[max_students]', [
                                'value' => $topic->max_students ?? '',
                                'type' => 'number',
                            ]) }}
                        </div>

                        <div class="col-md-6">
                            {{ Field::select(trans('lms::content.language'), 'meta[language]', [
                                'value' => $topic->language ?? '',
                                'options' => [
                                    'en' => 'English',
                                    'vi' => 'Vietnamese',
                                ],
                            ]) }}
                        </div>
                        {{-- difficulty level --}}
                        <div class="col-md-6">
                            {{ Field::select(trans('lms::content.difficulty_level'), 'meta[difficulty_level]', [
                                'value' => $topic->difficulty_level ?? '',
                                'options' => [
                                    'easy' => 'Easy',
                                    'medium' => 'Medium',
                                    'hard' => 'Hard',
                                ],
                            ]) }}
                        </div>
                        {{-- preview video url --}}
                        <div class="col-md-6">
                            {{ Field::text(trans('lms::content.preview_video_url'), 'meta[preview_video_url]', [
                                'value' => $topic->preview_video_url ?? '',
                            ]) }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tabs-curriculum">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">
                        {{ __('Curriculum') }}
                    </h4>
                    <div>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-topic">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            {{ __('Add Topic') }}
                        </a>
                    </div>
                </div>

                <div id="curriculum-items-container" class="curriculum-container">
                    <!-- Empty state - displayed when no curriculum items exist -->
                    <div class="curriculum-empty-state" id="curriculum-empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                            <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                            <path d="M3 6l0 13" />
                            <path d="M12 6l0 13" />
                            <path d="M21 6l0 13" />
                        </svg>
                        <h3>{{ __('No Curriculum Items Yet') }}</h3>
                        <p class="text-muted">{{ __('Start building your course by adding topics, lessons, quizzes, and assignments.') }}</p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-topic" type="button">
                            {{ __('Add Your First Topic') }}
                        </button>
                    </div>

                    <!-- Sample curriculum topics with lessons (this will be dynamically populated) -->
                    <div class="curriculum-topics" id="curriculum-topics" style="display: none;">
                        <!-- Topic 1 -->
                        <div class="curriculum-topic" data-id="1">
                            <div class="curriculum-topic-header">
                                <h5 class="curriculum-topic-title">Introduction to the Course</h5>
                                <div class="curriculum-topic-actions">
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-lesson">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                        {{ __('Add Item') }}
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="curriculum-items">
                                <div class="curriculum-item curriculum-item-video" data-id="1">
                                    <div class="d-flex align-items-center flex-grow-1">
                                        <span class="curriculum-item-type">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-video me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M15 10l4.553 -2.276a1 1 0 0 1 1.447 .894v6.764a1 1 0 0 1 -1.447 .894l-4.553 -2.276v-4z" />
                                                <path d="M3 6m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" />
                                            </svg>
                                            Video
                                        </span>
                                        <span class="curriculum-item-title">Welcome to the Course</span>
                                        <span class="curriculum-item-duration">10:30</span>
                                    </div>
                                    <div class="curriculum-item-actions">
                                        <button class="btn btn-sm btn-icon btn-ghost-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-ghost-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="curriculum-item curriculum-item-quiz" data-id="2">
                                    <div class="d-flex align-items-center flex-grow-1">
                                        <span class="curriculum-item-type">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-stackoverflow me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4 17v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-1" />
                                                <path d="M8 16h8" />
                                                <path d="M8.322 12.582l7.956 .836" />
                                                <path d="M8.787 9.168l7.826 1.664" />
                                                <path d="M10.096 5.764l7.608 2.472" />
                                            </svg>
                                            Quiz
                                        </span>
                                        <span class="curriculum-item-title">Introduction Quiz</span>
                                        <span class="curriculum-item-duration">5 questions</span>
                                    </div>
                                    <div class="curriculum-item-actions">
                                        <button class="btn btn-sm btn-icon btn-ghost-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-ghost-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tabs-media-area">
                <h4>
                    {{ __('Media') }}
                </h4>
                {{ Field::images(trans('lms::content.images'), 'meta[images]', [
                    'value' => $model->getMeta('images', []),
                    'data' => [
                        'show_label' => true,
                    ],
                ]) }}
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-topic" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Add New Topic') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label required">{{ __('Topic Title') }}</label>
                    <input type="text" class="form-control" id="topic-title" placeholder="{{ __('Enter topic title...') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Description') }}</label>
                    <textarea class="form-control" id="topic-description" rows="3" placeholder="{{ __('Enter topic description...') }}"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-primary" id="save-topic" data-bs-dismiss="modal">{{ __('Save Topic') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-lesson" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Add Curriculum Item') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">{{ __('Item Type') }}</label>
                    <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                        <label class="form-selectgroup-item">
                            <input type="radio" name="item-type" value="lesson" class="form-selectgroup-input" checked>
                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                <span class="me-3">
                                    <span class="form-selectgroup-check"></span>
                                </span>
                                <span class="form-selectgroup-label-content">
                                    <span class="form-selectgroup-title strong mb-1">{{ __('Lesson') }}</span>
                                    <span class="d-block text-muted">{{ __('Add a video, audio, or text lesson') }}</span>
                                </span>
                            </span>
                        </label>
                        <label class="form-selectgroup-item">
                            <input type="radio" name="item-type" value="quiz" class="form-selectgroup-input">
                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                <span class="me-3">
                                    <span class="form-selectgroup-check"></span>
                                </span>
                                <span class="form-selectgroup-label-content">
                                    <span class="form-selectgroup-title strong mb-1">{{ __('Quiz') }}</span>
                                    <span class="d-block text-muted">{{ __('Add a quiz to test knowledge') }}</span>
                                </span>
                            </span>
                        </label>
                        <label class="form-selectgroup-item">
                            <input type="radio" name="item-type" value="assignment" class="form-selectgroup-input">
                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                <span class="me-3">
                                    <span class="form-selectgroup-check"></span>
                                </span>
                                <span class="form-selectgroup-label-content">
                                    <span class="form-selectgroup-title strong mb-1">{{ __('Assignment') }}</span>
                                    <span class="d-block text-muted">{{ __('Add an assignment for students to complete') }}</span>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                
                <!-- Lesson Form (default visible) -->
                <div id="lesson-form">
                    <div class="mb-3">
                        <label class="form-label required">{{ __('Lesson Title') }}</label>
                        <input type="text" class="form-control" id="lesson-title" placeholder="{{ __('Enter lesson title...') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Lesson Type') }}</label>
                        <select class="form-select" id="lesson-type">
                            <option value="video">{{ __('Video') }}</option>
                            <option value="audio">{{ __('Audio') }}</option>
                            <option value="document">{{ __('Document') }}</option>
                            <option value="link">{{ __('External Link') }}</option>
                        </select>
                    </div>
                    <div class="mb-3" id="lesson-content-url">
                        <label class="form-label">{{ __('Content URL') }}</label>
                        <input type="text" class="form-control" id="lesson-url" placeholder="{{ __('Enter content URL...') }}">
                        <small class="form-hint">{{ __('YouTube, Vimeo, or direct file URL') }}</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Duration (minutes)') }}</label>
                        <input type="number" class="form-control" id="lesson-duration" placeholder="0" min="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" id="lesson-downloadable">
                            <span class="form-check-label">{{ __('Downloadable') }}</span>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Description') }}</label>
                        <textarea class="form-control" id="lesson-description" rows="3" placeholder="{{ __('Enter lesson description...') }}"></textarea>
                    </div>
                </div>
                
                <!-- Quiz Form (initially hidden) -->
                <div id="quiz-form" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label required">{{ __('Quiz Title') }}</label>
                        <input type="text" class="form-control" id="quiz-title" placeholder="{{ __('Enter quiz title...') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Time Limit (minutes)') }}</label>
                        <input type="number" class="form-control" id="quiz-time-limit" placeholder="0" min="0">
                        <small class="form-hint">{{ __('Leave empty for no time limit') }}</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Passing Score (%)') }}</label>
                        <input type="number" class="form-control" id="quiz-passing-score" placeholder="70" min="0" max="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Description') }}</label>
                        <textarea class="form-control" id="quiz-description" rows="3" placeholder="{{ __('Enter quiz description...') }}"></textarea>
                    </div>
                </div>
                
                <!-- Assignment Form (initially hidden) -->
                <div id="assignment-form" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label required">{{ __('Assignment Title') }}</label>
                        <input type="text" class="form-control" id="assignment-title" placeholder="{{ __('Enter assignment title...') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Assignment Instructions') }}</label>
                        <textarea class="form-control" id="assignment-instructions" rows="5" placeholder="{{ __('Enter detailed instructions...') }}"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Due Days') }}</label>
                        <input type="number" class="form-control" id="assignment-due-days" placeholder="7" min="1">
                        <small class="form-hint">{{ __('Number of days to complete after starting') }}</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Total Points') }}</label>
                        <input type="number" class="form-control" id="assignment-points" placeholder="100" min="1">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-primary" id="save-curriculum-item" data-bs-dismiss="modal">{{ __('Save Item') }}</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('input[name="form-imagecheck-radio"]').change(function() {
            if ($(this).val() == '2') {
                $('input[name="meta[price]"]').prop('disabled', false);
                $('input[name="meta[compare_price]"]').prop('disabled', false);
            } else {
                $('input[name="meta[price]"]').prop('disabled', true);
                $('input[name="meta[compare_price]"]').prop('disabled', true);
            }
        });

        // default checked item wise show or hide
        if ($('input[name="form-imagecheck-radio"]').val() == '2') {
            $('input[name="meta[price]"]').prop('disabled', false);
            $('input[name="meta[compare_price]"]').prop('disabled', false);
        } else {
            $('input[name="meta[price]"]').prop('disabled', true);
            $('input[name="meta[compare_price]"]').prop('disabled', true);
        }
        
        // Curriculum Item Type Selector
        $('input[name="item-type"]').change(function() {
            const selectedType = $(this).val();
            
            // Hide all forms first
            $('#lesson-form, #quiz-form, #assignment-form').hide();
            
            // Show the selected form
            if(selectedType === 'lesson') {
                $('#lesson-form').show();
            } else if(selectedType === 'quiz') {
                $('#quiz-form').show();
            } else if(selectedType === 'assignment') {
                $('#assignment-form').show();
            }
        });
        
        // Toggle between sample curriculum and empty state (for demo purposes)
        // In production, this would check for actual data
        const hasCurriculum = false; // Set to true to see the sample curriculum
        
        if(hasCurriculum) {
            $('#curriculum-empty-state').hide();
            $('#curriculum-topics').show();
        } else {
            $('#curriculum-empty-state').show();
            $('#curriculum-topics').hide();
        }
        
        // Lesson type change handler
        $('#lesson-type').change(function() {
            const lessonType = $(this).val();
            
            if(lessonType === 'document') {
                $('#lesson-content-url').find('small').text('{{ __("PDF, DOCX, or other document URL") }}');
            } else if(lessonType === 'video') {
                $('#lesson-content-url').find('small').text('{{ __("YouTube, Vimeo, or direct video file URL") }}');
            } else if(lessonType === 'audio') {
                $('#lesson-content-url').find('small').text('{{ __("Direct audio file URL or streaming audio URL") }}');
            } else if(lessonType === 'link') {
                $('#lesson-content-url').find('small').text('{{ __("External website or resource URL") }}');
            }
        });
        
        // Save Topic Button
        $('#save-topic').click(function() {
            const title = $('#topic-title').val();
            const description = $('#topic-description').val();
            
            if(!title) {
                alert('{{ __("Please enter a topic title") }}');
                return;
            }
            
            // Here you would typically save the topic via AJAX
            console.log("Saving topic:", { title, description });
            
            // For demo purposes, show the curriculum after adding a topic
            $('#curriculum-empty-state').hide();
            $('#curriculum-topics').show();
            
            // Clear the form
            $('#topic-title').val('');
            $('#topic-description').val('');
        });
        
        // Save Curriculum Item Button
        $('#save-curriculum-item').click(function() {
            const itemType = $('input[name="item-type"]:checked').val();
            let data = {};
            
            if(itemType === 'lesson') {
                data = {
                    title: $('#lesson-title').val(),
                    type: $('#lesson-type').val(),
                    url: $('#lesson-url').val(),
                    duration: $('#lesson-duration').val(),
                    downloadable: $('#lesson-downloadable').is(':checked'),
                    description: $('#lesson-description').val()
                };
            } else if(itemType === 'quiz') {
                data = {
                    title: $('#quiz-title').val(),
                    timeLimit: $('#quiz-time-limit').val(),
                    passingScore: $('#quiz-passing-score').val(),
                    description: $('#quiz-description').val()
                };
            } else if(itemType === 'assignment') {
                data = {
                    title: $('#assignment-title').val(),
                    instructions: $('#assignment-instructions').val(),
                    dueDays: $('#assignment-due-days').val(),
                    points: $('#assignment-points').val()
                };
            }
            
            // Validate required fields based on type
            if((itemType === 'lesson' && !data.title) || 
               (itemType === 'quiz' && !data.title) || 
               (itemType === 'assignment' && !data.title)) {
                alert('{{ __("Please enter a title") }}');
                return;
            }
            
            // Here you would typically save the item via AJAX
            console.log("Saving curriculum item:", { itemType, data });
            
            // Clear the form based on type
            if(itemType === 'lesson') {
                $('#lesson-title, #lesson-url, #lesson-duration, #lesson-description').val('');
                $('#lesson-downloadable').prop('checked', false);
            } else if(itemType === 'quiz') {
                $('#quiz-title, #quiz-time-limit, #quiz-passing-score, #quiz-description').val('');
            } else if(itemType === 'assignment') {
                $('#assignment-title, #assignment-instructions, #assignment-due-days, #assignment-points').val('');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('input[name="form-imagecheck-radio"]').change(function() {
            if ($(this).val() == '2') {
                $('input[name="meta[price]"]').prop('disabled', false);
                $('input[name="meta[compare_price]"]').prop('disabled', false);
            } else {
                $('input[name="meta[price]"]').prop('disabled', true);
                $('input[name="meta[compare_price]"]').prop('disabled', true);
            }
        });

        // default checked item wise show or hide
        if ($('input[name="form-imagecheck-radio"]').val() == '2') {
            $('input[name="meta[price]"]').prop('disabled', false);
            $('input[name="meta[compare_price]"]').prop('disabled', false);
        } else {
            $('input[name="meta[price]"]').prop('disabled', true);
            $('input[name="meta[compare_price]"]').prop('disabled', true);
        }
        
        // Curriculum Item Type Selector
        $('input[name="item-type"]').change(function() {
            const selectedType = $(this).val();
            
            // Hide all forms first
            $('#lesson-form, #quiz-form, #assignment-form').hide();
            
            // Show the selected form
            if(selectedType === 'lesson') {
                $('#lesson-form').show();
            } else if(selectedType === 'quiz') {
                $('#quiz-form').show();
            } else if(selectedType === 'assignment') {
                $('#assignment-form').show();
            }
        });
        
        // Toggle between sample curriculum and empty state (for demo purposes)
        // In production, this would check for actual data
        const hasCurriculum = false; // Set to true to see the sample curriculum
        
        if(hasCurriculum) {
            $('#curriculum-empty-state').hide();
            $('#curriculum-topics').show();
        } else {
            $('#curriculum-empty-state').show();
            $('#curriculum-topics').hide();
        }
        
        // Lesson type change handler
        $('#lesson-type').change(function() {
            const lessonType = $(this).val();
            
            if(lessonType === 'document') {
                $('#lesson-content-url').find('small').text('{{ __("PDF, DOCX, or other document URL") }}');
            } else if(lessonType === 'video') {
                $('#lesson-content-url').find('small').text('{{ __("YouTube, Vimeo, or direct video file URL") }}');
            } else if(lessonType === 'audio') {
                $('#lesson-content-url').find('small').text('{{ __("Direct audio file URL or streaming audio URL") }}');
            } else if(lessonType === 'link') {
                $('#lesson-content-url').find('small').text('{{ __("External website or resource URL") }}');
            }
        });
        
        // Save Topic Button
        $('#save-topic').click(function() {
            const title = $('#topic-title').val();
            const description = $('#topic-description').val();
            
            if(!title) {
                alert('{{ __("Please enter a topic title") }}');
                return;
            }
            
            // Here you would typically save the topic via AJAX
            console.log("Saving topic:", { title, description });
            
            // For demo purposes, show the curriculum after adding a topic
            $('#curriculum-empty-state').hide();
            $('#curriculum-topics').show();
            
            // Clear the form
            $('#topic-title').val('');
            $('#topic-description').val('');
        });
        
        // Save Curriculum Item Button
        $('#save-curriculum-item').click(function() {
            const itemType = $('input[name="item-type"]:checked').val();
            let data = {};
            
            if(itemType === 'lesson') {
                data = {
                    title: $('#lesson-title').val(),
                    type: $('#lesson-type').val(),
                    url: $('#lesson-url').val(),
                    duration: $('#lesson-duration').val(),
                    downloadable: $('#lesson-downloadable').is(':checked'),
                    description: $('#lesson-description').val()
                };
            } else if(itemType === 'quiz') {
                data = {
                    title: $('#quiz-title').val(),
                    timeLimit: $('#quiz-time-limit').val(),
                    passingScore: $('#quiz-passing-score').val(),
                    description: $('#quiz-description').val()
                };
            } else if(itemType === 'assignment') {
                data = {
                    title: $('#assignment-title').val(),
                    instructions: $('#assignment-instructions').val(),
                    dueDays: $('#assignment-due-days').val(),
                    points: $('#assignment-points').val()
                };
            }
            
            // Validate required fields based on type
            if((itemType === 'lesson' && !data.title) || 
               (itemType === 'quiz' && !data.title) || 
               (itemType === 'assignment' && !data.title)) {
                alert('{{ __("Please enter a title") }}');
                return;
            }
            
            // Here you would typically save the item via AJAX
            console.log("Saving curriculum item:", { itemType, data });
            
            // Clear the form based on type
            if(itemType === 'lesson') {
                $('#lesson-title, #lesson-url, #lesson-duration, #lesson-description').val('');
                $('#lesson-downloadable').prop('checked', false);
            } else if(itemType === 'quiz') {
                $('#quiz-title, #quiz-time-limit, #quiz-passing-score, #quiz-description').val('');
            } else if(itemType === 'assignment') {
                $('#assignment-title, #assignment-instructions, #assignment-due-days, #assignment-points').val('');
            }
        });

        // LMS Topic Management
        const LMS = {
            courseId: $('#lmsCurriculumContainer').data('course-id'),
            topics: [],
            baseUrl: '/admin/lms/topics',
            
            init: function() {
                this.bindEvents();
                this.loadTopics();
            },
            
            bindEvents: function() {
                // Topic actions
                $('.lms-add-topic-btn, #addTopicBtn').on('click', this.showAddTopicModal.bind(this));
                $('#saveTopic').on('click', this.saveTopic.bind(this));
                
                // Event delegation for dynamic elements
                $(document).on('click', '.edit-topic-btn', this.showEditTopicModal.bind(this));
                $(document).on('click', '.delete-topic-btn', this.confirmDeleteTopic.bind(this));
                $(document).on('click', '.lms-topic-header', this.toggleTopicCollapse.bind(this));
                $(document).on('click', '.lms-topic-toggle', function(e) {
                    e.stopPropagation();
                    const topicEl = $(this).closest('.lms-topic');
                    LMS.toggleTopicCollapse(null, topicEl);
                });
                
                // Confirmation modal
                $('#confirmAction').on('click', this.executeConfirmedAction.bind(this));
            },
            
            loadTopics: function() {
                const self = this;
                $('#lmsTopicLoading').show();
                $('#lmsTopicsContainer').hide();
                $('#lmsEmptyState').hide();
                $('#lmsAddMoreTopicBtn').hide();
                
                $.ajax({
                    url: `${this.baseUrl}/list/${this.courseId}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        self.topics = response.data || [];
                        self.renderTopics();
                    },
                    error: function(xhr) {
                        self.showToast('error', '{{ __("Error") }}', '{{ __("Could not load topics. Please try again.") }}');
                        console.error('Error loading topics:', xhr);
                    },
                    complete: function() {
                        $('#lmsTopicLoading').hide();
                    }
                });
            },
            
            renderTopics: function() {
                const container = $('#lmsTopicsContainer');
                container.empty();
                
                if (this.topics.length === 0) {
                    $('#lmsEmptyState').show();
                    container.hide();
                    $('#lmsAddMoreTopicBtn').hide();
                    return;
                }
                
                this.topics.forEach(topic => {
                    const topicHtml = this.getTopicHtml(topic);
                    container.append(topicHtml);
                });
                
                container.show();
                $('#lmsAddMoreTopicBtn').show();
                $('#lmsEmptyState').hide();
            },
            
            getTopicHtml: function(topic) {
                const template = $('#topicTemplate').html();
                const statusBadge = topic.status === 'publish' ? 'success' : 'warning';
                const statusText = topic.status === 'publish' ? '{{ __("Published") }}' : '{{ __("Draft") }}';
                
                return template
                    .replace(/{id}/g, topic.id)
                    .replace(/{title}/g, topic.title)
                    .replace(/{description}/g, topic.description || '{{ __("No description provided.") }}')
                    .replace(/{order}/g, topic.order)
                    .replace(/{statusBadge}/g, statusBadge)
                    .replace(/{statusText}/g, statusText);
            },
            
            showAddTopicModal: function() {
                $('#topicModalTitle').text('{{ __("Add New Topic") }}');
                $('#topicForm').trigger('reset');
                $('#topicId').val('');
                $('#topicCourseId').val(this.courseId);
                $('#topicOrder').val(this.topics.length);
                $('#topicStatus').prop('checked', true);
                $('#topicFormError').hide();
                
                // Reset validation
                $('#topicForm .is-invalid').removeClass('is-invalid');
                
                $('#topicModal').modal('show');
            },
            
            showEditTopicModal: function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const topicId = $(e.currentTarget).closest('.lms-topic').data('id');
                const topic = this.topics.find(t => t.id === topicId);
                
                if (!topic) {
                    this.showToast('error', '{{ __("Error") }}', '{{ __("Topic not found.") }}');
                    return;
                }
                
                $('#topicModalTitle').text('{{ __("Edit Topic") }}');
                $('#topicId').val(topic.id);
                $('#topicCourseId').val(this.courseId);
                $('#topicTitle').val(topic.title);
                $('#topicDescription').val(topic.description);
                $('#topicOrder').val(topic.order);
                $('#topicStatus').prop('checked', topic.status === 'publish');
                $('#topicFormError').hide();
                
                // Reset validation
                $('#topicForm .is-invalid').removeClass('is-invalid');
                
                $('#topicModal').modal('show');
            },
            
            saveTopic: function() {
                const self = this;
                const form = $('#topicForm');
                const isEdit = $('#topicId').val() !== '';
                
                // Simple validation
                let hasError = false;
                
                if (!$('#topicTitle').val().trim()) {
                    $('#topicTitle').addClass('is-invalid');
                    $('#topicTitleError').text('{{ __("Topic title is required.") }}');
                    hasError = true;
                } else {
                    $('#topicTitle').removeClass('is-invalid');
                }
                
                if (hasError) {
                    return;
                }
                
                // Show loading state
                $('#saveTopic').attr('disabled', true);
                $('#saveTopicText').hide();
                $('#saveTopicLoading').show();
                
                const formData = {
                    id: $('#topicId').val(),
                    course_id: $('#topicCourseId').val(),
                    title: $('#topicTitle').val().trim(),
                    description: $('#topicDescription').val().trim(),
                    order: $('#topicOrder').val(),
                    status: $('#topicStatus').is(':checked') ? 'publish' : 'draft'
                };
                
                $.ajax({
                    url: isEdit ? `${this.baseUrl}/${formData.id}` : this.baseUrl,
                    type: isEdit ? 'PUT' : 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (isEdit) {
                            const index = self.topics.findIndex(t => t.id === parseInt(formData.id));
                            if (index !== -1) {
                                self.topics[index] = response.data;
                            }
                            self.showToast('success', '{{ __("Success") }}', '{{ __("Topic updated successfully.") }}');
                        } else {
                            self.topics.push(response.data);
                            self.showToast('success', '{{ __("Success") }}', '{{ __("Topic created successfully.") }}');
                        }
                        
                        $('#topicModal').modal('hide');
                        self.renderTopics();
                    },
                    error: function(xhr) {
                        const errorMsg = xhr.responseJSON?.message || '{{ __("Something went wrong. Please try again.") }}';
                        $('#topicFormError').text(errorMsg).show();
                        
                        // Show field errors if available
                        if (xhr.responseJSON?.errors) {
                            const errors = xhr.responseJSON.errors;
                            
                            if (errors.title) {
                                $('#topicTitle').addClass('is-invalid');
                                $('#topicTitleError').text(errors.title[0]);
                            }
                            
                            if (errors.description) {
                                $('#topicDescription').addClass('is-invalid');
                                $('#topicDescriptionError').text(errors.description[0]);
                            }
                            
                            if (errors.order) {
                                $('#topicOrder').addClass('is-invalid');
                                $('#topicOrderError').text(errors.order[0]);
                            }
                        }
                        
                        console.error('Error saving topic:', xhr);
                    },
                    complete: function() {
                        $('#saveTopic').attr('disabled', false);
                        $('#saveTopicText').show();
                        $('#saveTopicLoading').hide();
                    }
                });
            },
            
            confirmDeleteTopic: function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const topicEl = $(e.currentTarget).closest('.lms-topic');
                const topicId = topicEl.data('id');
                const topic = this.topics.find(t => t.id === topicId);
                
                if (!topic) {
                    this.showToast('error', '{{ __("Error") }}', '{{ __("Topic not found.") }}');
                    return;
                }
                
                $('#confirmationMessage').html(`{{ __("You are about to delete the topic") }} <strong>${topic.title}</strong>. {{ __("This will also delete all lessons associated with this topic. This action cannot be undone.") }}`);
                
                // Set action for confirmation modal
                $('#confirmAction')
                    .text('{{ __("Yes, delete") }}')
                    .data('action', 'delete-topic')
                    .data('id', topicId);
                
                $('#confirmationModal').modal('show');
            },
            
            deleteTopic: function(topicId) {
                const self = this;
                
                $.ajax({
                    url: `${this.baseUrl}/${topicId}`,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(response) {
                        self.topics = self.topics.filter(t => t.id !== topicId);
                        self.renderTopics();
                        self.showToast('success', '{{ __("Success") }}', '{{ __("Topic deleted successfully.") }}');
                    },
                    error: function(xhr) {
                        self.showToast('error', '{{ __("Error") }}', '{{ __("Could not delete topic. Please try again.") }}');
                        console.error('Error deleting topic:', xhr);
                    }
                });
            },
            
            executeConfirmedAction: function() {
                const action = $('#confirmAction').data('action');
                const id = $('#confirmAction').data('id');
                
                $('#confirmationModal').modal('hide');
                
                if (action === 'delete-topic') {
                    this.deleteTopic(id);
                }
            },
            
            toggleTopicCollapse: function(e, topicEl) {
                if (!topicEl) {
                    topicEl = $(e.currentTarget).closest('.lms-topic');
                    e.preventDefault();
                }
                
                topicEl.toggleClass('lms-topic-collapsed');
            },
            
            showToast: function(type, title, message) {
                const toastId = 'toast-' + Date.now();
                const iconClass = type === 'success' ? 'icon-tabler-check' : 
                                 type === 'error' ? 'icon-tabler-alert-triangle' : 
                                 'icon-tabler-info-circle';
                
                const toastHtml = `
                    <div class="lms-toast lms-toast-${type}" id="${toastId}">
                        <div class="lms-toast-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler ${iconClass}" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                ${type === 'success' ? 
                                '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" />' : 
                                type === 'error' ? 
                                '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />' : 
                                '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" />'}
                            </svg>
                        </div>
                        <div class="lms-toast-content">
                            <div class="lms-toast-title">${title}</div>
                            <div class="lms-toast-message">${message}</div>
                        </div>
                        <button type="button" class="lms-toast-close" onclick="document.getElementById('${toastId}').remove()">×</button>
                    </div>
                `;
                
                $('#lmsToastContainer').append(toastHtml);
                
                // Give a small delay before showing the toast for proper animation
                setTimeout(() => {
                    $('#' + toastId).addClass('show');
                }, 10);
                
                // Auto-hide after 5 seconds
                setTimeout(() => {
                    const toast = $('#' + toastId);
                    toast.removeClass('show');
                    setTimeout(() => {
                        toast.remove();
                    }, 300);
                }, 5000);
            }
        };
        
        // Initialize LMS
        LMS.init();
    });
</script>