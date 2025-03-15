@php
    /**
     * @var \Juzaweb\Backend\Models\Post $model
     * @var \Juzaweb\merce\Models\Producttopic $topic
     */
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

    /* LMS CSS Styles */

    /* Main Container Styles */
    .lms-curriculum-container {
        background-color: #f9f9fb;
        border-radius: 0.5rem;
        padding: 1.5rem;
    }

    /* Empty State Styles */
    .lms-empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 3rem 1.5rem;
        text-align: center;
        background-color: #fff;
        border-radius: 0.5rem;
        border: 1px dashed #d1d5db;
    }

    .lms-empty-state-icon {
        width: 5rem;
        height: 5rem;
        color: #6b7280;
        margin-bottom: 1.5rem;
    }

    .lms-empty-state-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: #374151;
    }

    .lms-empty-state-text {
        color: #6b7280;
        max-width: 32rem;
        margin-bottom: 1.5rem;
    }

    /* Topic Styles */
    .lms-topics-container {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .lms-topic {
        background-color: #fff;
        border-radius: 0.5rem;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .lms-topic-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem;
        background-color: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        cursor: move;
    }

    .lms-topic-title-wrapper {
        display: flex;
        align-items: center;
        flex: 1;
    }

    .lms-topic-toggle {
        display: flex;
        align-items: center;
        margin-right: 0.5rem;
        cursor: pointer;
        color: #6b7280;
        transition: transform 0.2s ease;
    }

    .lms-topic-title {
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
        color: #1f2937;
    }

    .lms-topic-actions {
        display: flex;
        gap: 0.5rem;
    }

    .lms-topic-content {
        padding: 1rem;
        display: none;
    }

    .lms-topic-expanded .lms-topic-content {
        display: block;
    }

    .lms-topic-description {
        color: #6b7280;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }

    .lms-topic-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 1rem;
        background-color: #f9fafb;
        border-top: 1px solid #e5e7eb;
    }

    /* Lesson Container Styles */
    .lms-lessons-container {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .lms-lesson-item {
        background-color: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 0.375rem;
        overflow: hidden;
    }

    .lms-lesson-header {
        display: flex;
        align-items: center;
        padding: 0.75rem;
        cursor: move;
    }

    .lms-lesson-type-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        margin-right: 0.75rem;
    }

    .lms-lesson-info {
        flex: 1;
    }

    .lms-lesson-title {
        margin: 0 0 0.25rem 0;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .lms-lesson-type {
        font-size: 0.75rem;
    }

    .lms-lesson-actions {
        display: flex;
        gap: 0.25rem;
    }

    /* Loading Spinner */
    .lms-spinner {
        width: 2rem;
        height: 2rem;
        border: 0.25rem solid rgba(59, 130, 246, 0.25);
        border-right-color: #3b82f6;
        border-radius: 50%;
        animation: lms-spinner 1s linear infinite;
    }

    /* LMS Curriculum Styles */
    .lms-topics-container {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        margin-top: 1.5rem;
    }

    .lms-topic {
        background-color: #fff;
        border-radius: 0.5rem;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .lms-topic-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem;
        background-color: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        cursor: pointer;
    }

    .lms-topic-title-wrapper {
        display: flex;
        align-items: center;
        flex: 1;
    }

    .lms-topic-toggle {
        display: flex;
        align-items: center;
        margin-right: 0.5rem;
        cursor: pointer;
        color: #6b7280;
        transition: transform 0.2s ease;
    }

    .lms-topic-title {
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
        color: #1f2937;
    }

    .lms-topic-actions {
        display: flex;
        gap: 0.5rem;
    }

    .lms-topic-content {
        padding: 1rem;
    }

    .lms-topic-description {
        color: #6b7280;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }

    .lms-topic-footer {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        background-color: #f9fafb;
        border-top: 1px solid #e5e7eb;
    }

    .lms-lessons-container {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .lms-lesson-item {
        background-color: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 0.375rem;
        overflow: hidden;
    }

    .lms-lesson-header {
        display: flex;
        align-items: center;
        padding: 0.75rem;
        cursor: move;
    }

    .lms-lesson-type-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        margin-right: 0.75rem;
    }

    .lms-lesson-info {
        flex: 1;
    }

    .lms-lesson-title {
        margin: 0 0 0.25rem 0;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .lms-lesson-type {
        font-size: 0.75rem;
    }

    .lms-lesson-actions {
        display: flex;
        gap: 0.25rem;
    }

    .lms-empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 3rem 1.5rem;
        text-align: center;
        background-color: #fff;
        border-radius: 0.5rem;
        border: 1px dashed #d1d5db;
    }

    .lms-empty-lesson {
        padding: 1rem;
        text-align: center;
        background-color: #f9fafb;
        border-radius: 0.375rem;
        border: 1px dashed #d1d5db;
    }

    /* Loading spinner */
    .lms-spinner {
        width: 2rem;
        height: 2rem;
        border: 0.25rem solid rgba(59, 130, 246, 0.25);
        border-right-color: #3b82f6;
        border-radius: 50%;
        animation: lms-spinner 1s linear infinite;
    }

    @keyframes lms-spinner {
        to {
            transform: rotate(360deg);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .lms-topic-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .lms-topic-actions {
            width: 100%;
            justify-content: flex-end;
        }

        .lms-lesson-item {
            flex-wrap: wrap;
        }

        .lms-lesson-actions {
            width: 100%;
            justify-content: flex-end;
            margin-top: 0.5rem;
        }
    }


    /* LMS Curriculum Styles */
    .lms-topics-container {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        margin-top: 1.5rem;
    }

    .lms-topic {
        background-color: #fff;
        border-radius: 0.5rem;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .lms-topic-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem;
        background-color: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        cursor: pointer;
    }

    .lms-topic-title-wrapper {
        display: flex;
        align-items: center;
        flex: 1;
    }

    .lms-topic-toggle {
        display: flex;
        align-items: center;
        margin-right: 0.5rem;
        cursor: pointer;
        color: #6b7280;
        transition: transform 0.2s ease;
    }

    .lms-topic-title {
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
        color: #1f2937;
    }

    .lms-topic-actions {
        display: flex;
        gap: 0.5rem;
    }

    .lms-topic-content {
        padding: 1rem;
        display: none;
        /* Hidden by default, will be toggled by JavaScript */
    }

    .lms-topic-expanded .lms-topic-content {
        display: block !important;
        /* Force display when expanded */
    }

    .lms-topic-description {
        color: #6b7280;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }

    .lms-topic-footer {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        background-color: #f9fafb;
        border-top: 1px solid #e5e7eb;
        margin-top: .6rem;
    }
</style>


<div class="card mt-3 mb-3">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
            <li class="nav-item">
                <a href="#tabs-curriculum" class="nav-link active" data-bs-toggle="tab">
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
                <a href="#tabs-product-info" class="nav-link" data-bs-toggle="tab">
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

            <div class="tab-pane show active" id="tabs-curriculum">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">
                        {{ __('Curriculum') }}
                    </h4>
                    <div>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#topicModal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            {{ __('Add Topic') }}
                        </a>
                    </div>
                </div>
                @php
                    $courseId = $model->id ?? 1;
                @endphp
                <div id="lmsManager" data-course-id="{{ $courseId }}"></div>

                <div id="curriculum-items-container" class="curriculum-container">
                    <!-- Empty state - displayed when no curriculum items exist -->
                    <div class="curriculum-empty-state" id="lmsEmptyState">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                            <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                            <path d="M3 6l0 13" />
                            <path d="M12 6l0 13" />
                            <path d="M21 6l0 13" />
                        </svg>
                        <h3>{{ __('No Curriculum Items Yet') }}</h3>
                        <p class="text-muted">
                            {{ __('Start building your course by adding topics, lessons, quizzes, and assignments.') }}
                        </p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#topicModal"
                            type="button">
                            {{ __('Add Your First Topic') }}
                        </button>
                    </div>

                    <!-- Add More Topic Button (hidden initially) -->
                    <div class="text-center mb-3" id="lmsAddMoreTopicBtn" style="display: none;">
                        <button class="btn btn-primary lms-add-topic-btn" data-bs-toggle="modal"
                            data-bs-target="#topicModal" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            {{ __('Add Another Topic') }}
                        </button>
                    </div>

                    <!-- Topics Container -->
                    <div class="lms-topics-container" id="lmsTopicsContainer">
                        <!-- Topics will be dynamically added here -->
                    </div>

                    <!-- Loading Indicator -->
                    <div class="text-center py-4" id="lmsTopicLoading" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane show" id="tabs-product-info">
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

<div class="alert alert-danger d-none" id="topicFormError"></div>

<div class="modal modal-blur fade" id="topicModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div id="topicForm" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="topicModalTitle">{{ __('Add New Topic') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label required">{{ __('Topic Title') }}</label>
                    <input type="text" class="form-control" id="topicTitle" name="title"
                        placeholder="{{ __('Enter topic title...') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Description') }}</label>
                    <textarea class="form-control" id="topicDescription" rows="3" name="description"
                        placeholder="{{ __('Enter topic description...') }}"></textarea>
                </div>
            </div>
            <input type="hidden" name="id" id="topicId">
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-primary" id="saveTopic">
                    <span class="d-none" id="saveTopicLoading">
                        <span class="spinner-border spinner-border-sm"></span>
                    </span>
                    <span id="saveTopicText">{{ __('Save Topic') }}</span>
                </button>
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
                            <input type="radio" name="item-type" value="lesson" class="form-selectgroup-input"
                                checked>
                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                <span class="me-3">
                                    <span class="form-selectgroup-check"></span>
                                </span>
                                <span class="form-selectgroup-label-content">
                                    <span class="form-selectgroup-title strong mb-1">{{ __('Lesson') }}</span>
                                    <span
                                        class="d-block text-muted">{{ __('Add a video, audio, or text lesson') }}</span>
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
                            <input type="radio" name="item-type" value="assignment"
                                class="form-selectgroup-input">
                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                <span class="me-3">
                                    <span class="form-selectgroup-check"></span>
                                </span>
                                <span class="form-selectgroup-label-content">
                                    <span class="form-selectgroup-title strong mb-1">{{ __('Assignment') }}</span>
                                    <span
                                        class="d-block text-muted">{{ __('Add an assignment for students to complete') }}</span>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Lesson Form (default visible) -->
                <div id="lesson-form">
                    <div class="mb-3">
                        <label class="form-label required">{{ __('Lesson Title') }}</label>
                        <input type="text" class="form-control" id="lesson-title"
                            placeholder="{{ __('Enter lesson title...') }}" required>
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
                        <input type="text" class="form-control" id="lesson-url"
                            placeholder="{{ __('Enter content URL...') }}">
                        <small class="form-hint">{{ __('YouTube, Vimeo, or direct file URL') }}</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Duration (minutes)') }}</label>
                        <input type="number" class="form-control" id="lesson-duration" placeholder="0"
                            min="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" id="lesson-downloadable">
                            <span class="form-check-label">{{ __('Downloadable') }}</span>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Description') }}</label>
                        <textarea class="form-control" id="lesson-description" rows="3"
                            placeholder="{{ __('Enter lesson description...') }}"></textarea>
                    </div>
                </div>

                <!-- Quiz Form (initially hidden) -->
                <div id="quiz-form" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label required">{{ __('Quiz Title') }}</label>
                        <input type="text" class="form-control" id="quiz-title"
                            placeholder="{{ __('Enter quiz title...') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Time Limit (minutes)') }}</label>
                        <input type="number" class="form-control" id="quiz-time-limit" placeholder="0"
                            min="0">
                        <small class="form-hint">{{ __('Leave empty for no time limit') }}</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Passing Score (%)') }}</label>
                        <input type="number" class="form-control" id="quiz-passing-score" placeholder="70"
                            min="0" max="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Description') }}</label>
                        <textarea class="form-control" id="quiz-description" rows="3"
                            placeholder="{{ __('Enter quiz description...') }}"></textarea>
                    </div>
                </div>

                <!-- Assignment Form (initially hidden) -->
                <div id="assignment-form" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label required">{{ __('Assignment Title') }}</label>
                        <input type="text" class="form-control" id="assignment-title"
                            placeholder="{{ __('Enter assignment title...') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Assignment Instructions') }}</label>
                        <textarea class="form-control" id="assignment-instructions" rows="5"
                            placeholder="{{ __('Enter detailed instructions...') }}"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Due Days') }}</label>
                        <input type="number" class="form-control" id="assignment-due-days" placeholder="7"
                            min="1">
                        <small class="form-hint">{{ __('Number of days to complete after starting') }}</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Total Points') }}</label>
                        <input type="number" class="form-control" id="assignment-points" placeholder="100"
                            min="1">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-primary" id="save-curriculum-item"
                    data-bs-dismiss="modal">{{ __('Save Item') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Lesson Modal -->
<div class="modal modal-blur fade" id="lessonModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Add Lesson') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="lessonForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label required">{{ __('Lesson Title') }}</label>
                        <input type="text" class="form-control" name="title" required
                            placeholder="{{ __('Enter lesson title...') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Lesson Type') }}</label>
                        <select class="form-select" name="type">
                            <option value="video">{{ __('Video') }}</option>
                            <option value="audio">{{ __('Audio') }}</option>
                            <option value="document">{{ __('Document') }}</option>
                            <option value="link">{{ __('External Link') }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Content URL') }}</label>
                        <input type="url" class="form-control" name="content_url"
                            placeholder="{{ __('Enter content URL...') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Duration (minutes)') }}</label>
                        <input type="number" class="form-control" name="duration" min="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" name="downloadable">
                            <span class="form-check-label">{{ __('Downloadable') }}</span>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Description') }}</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-primary" id="saveLesson">
                        <span class="d-none" id="saveLessonLoading">
                            <span class="spinner-border spinner-border-sm"></span>
                        </span>
                        <span id="saveLessonText">{{ __('Save Lesson') }}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quiz Modal -->
<div class="modal modal-blur fade" id="quizModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Add Quiz') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="quizForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label required">{{ __('Quiz Title') }}</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Time Limit (minutes)') }}</label>
                        <input type="number" class="form-control" name="time_limit" min="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Passing Score (%)') }}</label>
                        <input type="number" class="form-control" name="passing_score" min="0"
                            max="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Description') }}</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary" id="saveQuiz">
                        <span class="d-none" id="saveQuizLoading"></span>
                        <span id="saveQuizText">{{ __('Save Quiz') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Assignment Modal -->
<div class="modal modal-blur fade" id="assignmentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Add Assignment') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="assignmentForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label required">{{ __('Assignment Title') }}</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Instructions') }}</label>
                        <textarea class="form-control" name="instructions" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Due Days') }}</label>
                        <input type="number" class="form-control" name="due_days" min="1">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Total Points') }}</label>
                        <input type="number" class="form-control" name="points" min="1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary" id="saveAssignment">
                        <span class="d-none" id="saveAssignmentLoading"></span>
                        <span id="saveAssignmentText">{{ __('Save Assignment') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal modal-blur fade" id="confirmationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Confirm Action') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="confirmationMessage">{{ __('Are you sure you want to perform this action?') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
                    {{ __('Cancel') }}
                </button>
                <button type="button" class="btn btn-danger" id="confirmAction">
                    {{ __('Confirm') }}
                </button>
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
    });
</script>

<!-- Topic Template -->
<template id="topicTemplate">
    <div class="lms-topic">
        <div class="lms-topic-header">
            <div class="lms-topic-title-wrapper">
                <div class="lms-topic-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9 6l6 6l-6 6"></path>
                    </svg>
                </div>
                <h5 class="lms-topic-title">Topic Title</h5>
                <span class="badge bg-success ms-2">Published</span>
                <small class="text-muted small ms-2">Order: 0</small>
            </div>
            <div class="lms-topic-actions">
                <button class="btn btn-sm btn-outline-secondary edit-topic-btn" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                        <path d="M16 5l3 3"></path>
                    </svg>
                    Edit
                </button>
                <button class="btn btn-sm btn-outline-danger delete-topic-btn" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 7l16 0"></path>
                        <path d="M10 11l0 6"></path>
                        <path d="M14 11l0 6"></path>
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                    </svg>
                    Delete
                </button>
            </div>
        </div>
        <div class="lms-topic-content" style="display: none;">
            <p class="lms-topic-description">Topic description goes here.</p>
            <div class="lms-lessons-container" data-topic-id="">
                <div class="lms-empty-lesson">
                    <p class="text-muted text-center">No items in this topic yet. Add your first item below.</p>
                </div>
            </div>
            <div class="lms-topic-footer">
                <button type="button" class="btn btn-sm btn-outline-primary add-lesson-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 5l0 14"></path>
                        <path d="M5 12l14 0"></path>
                    </svg>
                    Add Lesson
                </button>
            </div>
        </div>
    </div>
</template>

<!-- Lesson Template -->
<template id="lessonTemplate">
    <div class="lms-lesson-item">
        <div class="lms-lesson-header">
            <div class="lms-lesson-type-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-video" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M15 10l4.553 -2.276a1 1 0 0 1 1.447 .894v6.764a1 1 0 0 1 -1.447 .894l-4.553 -2.276v-4z">
                    </path>
                    <path d="M3 6m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"></path>
                </svg>
            </div>
            <div class="lms-lesson-info">
                <h6 class="lms-lesson-title">Lesson Title</h6>
                <span class="lms-lesson-type">Video</span>
            </div>
            <div class="lms-lesson-actions">
                <button class="btn btn-sm btn-icon btn-ghost-secondary edit-lesson-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                        <path d="M16 5l3 3"></path>
                    </svg>
                </button>
                <button class="btn btn-sm btn-icon btn-ghost-danger delete-lesson-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 7l16 0"></path>
                        <path d="M10 11l0 6"></path>
                        <path d="M14 11l0 6"></path>
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>

<script src="{{ asset('jw-styles/plugins/mojahid/lms/assets/js/lms.min.js') }}" type="text/javascript"></script>

<script>
    // Ensure LMSManager is initialized after the script is loaded
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM content loaded in inline script');

        // Check if LMSManager was already initialized
        if (!window.lmsManager) {
            console.log('LMSManager not initialized yet, initializing now');

            // Wait a bit to ensure all scripts are loaded
            setTimeout(function() {
                try {
                    window.lmsManager = new LMSManager();
                    console.log('LMSManager initialized from inline script');

                    // Force load topics
                    if (window.lmsManager && window.lmsManager.loadTopics) {
                        console.log('Forcing loadTopics call');
                        window.lmsManager.loadTopics();
                    }
                } catch (error) {
                    console.error('Error initializing LMSManager from inline script:', error);
                }
            }, 500);
        } else {
            console.log('LMSManager already initialized');

            // Force load topics
            if (window.lmsManager && window.lmsManager.loadTopics) {
                console.log('Forcing loadTopics call');
                window.lmsManager.loadTopics();
            }
        }
    });
</script>
