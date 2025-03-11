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

    /* LMS Topic Management Styles */
    .lms-curriculum-container {
        position: relative;
        padding: 1rem 0;
    }

    .lms-empty-state {
        text-align: center;
        padding: 3rem 2rem;
        border-radius: 0.5rem;
        background-color: rgba(var(--tblr-light-rgb), 0.5);
        margin-bottom: 1rem;
    }

    .lms-empty-state-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        color: var(--tblr-primary);
        opacity: 0.7;
    }

    .lms-empty-state-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .lms-empty-state-text {
        color: var(--tblr-secondary);
        margin-bottom: 1.5rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .lms-topics-container {
        margin-bottom: 1.5rem;
    }

    .lms-topic {
        border: 1px solid rgba(var(--tblr-secondary-rgb), 0.15);
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        background-color: #fff;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .lms-topic-header {
        padding: 1rem;
        background-color: rgba(var(--tblr-primary-rgb), 0.03);
        border-bottom: 1px solid rgba(var(--tblr-secondary-rgb), 0.1);
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
    }

    .lms-topic-collapsed .lms-topic-header {
        border-bottom: none;
    }

    .lms-topic-title-wrapper {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex: 1;
    }

    .lms-topic-title {
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
    }

    .lms-topic-toggle {
        transition: transform 0.2s ease;
    }

    .lms-topic-collapsed .lms-topic-toggle {
        transform: rotate(-90deg);
    }

    .lms-topic-actions {
        display: flex;
        gap: 0.5rem;
    }

    .lms-topic-content {
        padding: 0.75rem 1rem;
    }

    .lms-topic-collapsed .lms-topic-content {
        display: none;
    }

    .lms-topic-description {
        margin-bottom: 1rem;
        font-size: 0.9rem;
        color: var(--tblr-secondary);
    }

    .lms-topic-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 1rem;
        background-color: rgba(var(--tblr-light-rgb), 0.5);
        border-top: 1px solid rgba(var(--tblr-secondary-rgb), 0.1);
    }

    .lms-topic-collapsed .lms-topic-footer {
        display: none;
    }

    .lms-add-topic-btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Toast notification system */
    .lms-toast-container {
        position: fixed;
        top: 1rem;
        right: 1rem;
        z-index: 9999;
        max-width: 350px;
    }

    .lms-toast {
        margin-bottom: 0.75rem;
        background-color: #fff;
        border-radius: 0.25rem;
        padding: 1rem;
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: flex-start;
        border-left: 4px solid var(--tblr-primary);
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.3s ease;
    }

    .lms-toast.show {
        opacity: 1;
        transform: translateX(0);
    }

    .lms-toast-success {
        border-left-color: var(--tblr-success);
    }

    .lms-toast-error {
        border-left-color: var(--tblr-danger);
    }

    .lms-toast-warning {
        border-left-color: var(--tblr-warning);
    }

    .lms-toast-icon {
        margin-right: 0.75rem;
        font-size: 1.25rem;
    }

    .lms-toast-success .lms-toast-icon {
        color: var(--tblr-success);
    }

    .lms-toast-error .lms-toast-icon {
        color: var(--tblr-danger);
    }

    .lms-toast-warning .lms-toast-icon {
        color: var(--tblr-warning);
    }

    .lms-toast-content {
        flex: 1;
    }

    .lms-toast-title {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .lms-toast-message {
        font-size: 0.875rem;
        color: var(--tblr-secondary);
    }

    .lms-toast-close {
        color: var(--tblr-secondary);
        background: transparent;
        border: none;
        padding: 0;
        cursor: pointer;
        font-size: 1.25rem;
        line-height: 1;
    }

    /* Spinner for loading states */
    .lms-spinner {
        width: 1.5rem;
        height: 1.5rem;
        border: 2px solid rgba(var(--tblr-primary-rgb), 0.2);
        border-top-color: var(--tblr-primary);
        border-radius: 50%;
        animation: spinner 0.6s linear infinite;
    }

    @keyframes spinner {
        to {
            transform: rotate(360deg);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .lms-topic-header {
            flex-wrap: wrap;
        }

        .lms-topic-actions {
            margin-top: 0.5rem;
            width: 100%;
            justify-content: flex-end;
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
                        <button type="button" class="btn btn-primary lms-add-topic-btn" id="addTopicBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            {{ __('Add Topic') }}
                        </button>
                    </div>
                </div>

                <div id="lmsCurriculumContainer" class="lms-curriculum-container" data-course-id="{{ $model->id ?? 0 }}">
                    <!-- Empty state - shows when no topics exist -->
                    <div id="lmsEmptyState" class="lms-empty-state" style="display: none;">
                        <div class="lms-empty-state-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book" width="100%" height="100%" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                                <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                                <path d="M3 6l0 13" />
                                <path d="M12 6l0 13" />
                                <path d="M21 6l0 13" />
                            </svg>
                        </div>
                        <h3 class="lms-empty-state-title">{{ __('No Topics Yet') }}</h3>
                        <p class="lms-empty-state-text">{{ __('Start building your course by adding topics. You can then add lessons, quizzes, and assignments to each topic.') }}</p>
                        <button type="button" class="btn btn-primary lms-add-topic-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            {{ __('Create Your First Topic') }}
                        </button>
                    </div>

                    <!-- Topics container -->
                    <div id="lmsTopicsContainer" class="lms-topics-container">
                        <!-- Topics will be loaded here dynamically -->
                    </div>

                    <!-- Add topic button (shown when there are already topics) -->
                    <div id="lmsAddMoreTopicBtn" class="text-center mb-3" style="display: none;">
                        <button type="button" class="btn btn-outline-primary lms-add-topic-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            {{ __('Add Another Topic') }}
                        </button>
                    </div>

                    <!-- Loading indicator -->
                    <div id="lmsTopicLoading" class="text-center py-4" style="display: none;">
                        <div class="lms-spinner mx-auto"></div>
                        <p class="text-muted mt-2">{{ __('Loading topics...') }}</p>
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

<!-- Topic Modal -->
<div class="modal modal-blur fade" id="topicModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="topicModalTitle">{{ __('Add New Topic') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="topicForm">
                    <input type="hidden" id="topicId" name="id" value="">
                    <input type="hidden" id="topicCourseId" name="course_id" value="{{ $model->id ?? 0 }}">
                    
                    <div class="mb-3">
                        <label class="form-label required" for="topicTitle">{{ __('Topic Title') }}</label>
                        <input type="text" class="form-control" id="topicTitle" name="title" required>
                        <div class="invalid-feedback" id="topicTitleError"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" for="topicDescription">{{ __('Description') }}</label>
                        <textarea class="form-control" id="topicDescription" name="description" rows="3"></textarea>
                        <div class="invalid-feedback" id="topicDescriptionError"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" for="topicOrder">{{ __('Order') }}</label>
                        <input type="number" class="form-control" id="topicOrder" name="order" min="0" value="0">
                        <div class="invalid-feedback" id="topicOrderError"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" id="topicStatus" name="status" value="publish" checked>
                            <span class="form-check-label">{{ __('Published') }}</span>
                        </label>
                    </div>
                </form>
                
                <!-- Error message area -->
                <div class="alert alert-danger mt-3" id="topicFormError" style="display: none;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-primary" id="saveTopic">
                    <span id="saveTopicText">{{ __('Save Topic') }}</span>
                    <span id="saveTopicLoading" style="display: none;">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        {{ __('Saving...') }}
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Toast container for notifications -->
<div class="lms-toast-container" id="lmsToastContainer"></div>

<!-- Topic template for JavaScript rendering -->
<template id="topicTemplate">
    <div class="lms-topic" data-id="{id}">
        <div class="lms-topic-header">
            <div class="lms-topic-title-wrapper">
                <span class="lms-topic-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M6 9l6 6l6 -6" />
                    </svg>
                </span>
                <h5 class="lms-topic-title">{title}</h5>
                <span class="badge bg-{statusBadge} ms-2">{statusText}</span>
            </div>
            <div class="lms-topic-actions">
                <button type="button" class="btn btn-sm btn-icon btn-outline-primary edit-topic-btn" title="{{ __('Edit Topic') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                        <path d="M16 5l3 3" />
                    </svg>
                </button>
                <button type="button" class="btn btn-sm btn-icon btn-outline-danger delete-topic-btn" title="{{ __('Delete Topic') }}">
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
        <div class="lms-topic-content">
            <div class="lms-topic-description">{description}</div>
            <div class="lms-lessons-container" data-topic-id="{id}">
                <!-- Lessons will be added here -->
                <div class="text-center py-3 text-muted">
                    <p>{{ __('No lessons added to this topic yet.') }}</p>
                </div>
            </div>
        </div>
        <div class="lms-topic-footer">
            <span class="text-muted small">{{ __('Order') }}: {order}</span>
            <button type="button" class="btn btn-sm btn-outline-primary add-lesson-btn" data-topic-id="{id}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                </svg>
                {{ __('Add Lesson') }}
            </button>
        </div>
    </div>
</template>

<!-- Confirmation Modal -->
<div class="modal modal-blur fade" id="confirmationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">{{ __('Are you sure?') }}</div>
                <div id="confirmationMessage">{{ __('This action cannot be undone.') }}</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-danger" id="confirmAction">{{ __('Yes, delete') }}</button>
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