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

    /* Enhanced LMS Topic Management Styles */
    .lms-curriculum-container {
        position: relative;
        padding: 1.5rem;
        background: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .lms-empty-state {
        text-align: center;
        padding: 4rem 2rem;
        border-radius: 0.75rem;
        background: linear-gradient(to bottom right, rgba(var(--tblr-primary-rgb), 0.05), rgba(var(--tblr-primary-rgb), 0.1));
        margin-bottom: 1.5rem;
        border: 2px dashed rgba(var(--tblr-primary-rgb), 0.2);
        transition: all 0.3s ease;
    }

    .lms-empty-state:hover {
        border-color: rgba(var(--tblr-primary-rgb), 0.4);
        background: linear-gradient(to bottom right, rgba(var(--tblr-primary-rgb), 0.08), rgba(var(--tblr-primary-rgb), 0.15));
    }

    .lms-empty-state-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 2rem;
        color: var(--tblr-primary);
        opacity: 0.8;
        transition: transform 0.3s ease;
    }

    .lms-empty-state:hover .lms-empty-state-icon {
        transform: scale(1.05);
    }

    .lms-empty-state-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--tblr-primary);
    }

    .lms-empty-state-text {
        color: var(--tblr-secondary);
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    .lms-topics-container {
        margin-bottom: 2rem;
    }

    .lms-topic {
        border: 1px solid rgba(var(--tblr-secondary-rgb), 0.15);
        border-radius: 0.75rem;
        margin-bottom: 1rem;
        background-color: #fff;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .lms-topic:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transform: translateY(-1px);
    }

    .lms-topic.is-dragging {
        opacity: 0.9;
        transform: scale(1.02);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .lms-topic-header {
        padding: 1.25rem;
        background: linear-gradient(to right, rgba(var(--tblr-primary-rgb), 0.03), rgba(var(--tblr-primary-rgb), 0.08));
        border-bottom: 1px solid rgba(var(--tblr-secondary-rgb), 0.1);
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .lms-topic-header:hover {
        background: linear-gradient(to right, rgba(var(--tblr-primary-rgb), 0.05), rgba(var(--tblr-primary-rgb), 0.1));
    }

    .lms-topic-title-wrapper {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex: 1;
    }

    .lms-topic-drag-handle {
        cursor: move;
        color: var(--tblr-secondary);
        opacity: 0.5;
        transition: opacity 0.3s ease;
    }

    .lms-topic-header:hover .lms-topic-drag-handle {
        opacity: 1;
    }

    .lms-topic-title {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--tblr-primary);
    }

    .lms-topic-toggle {
        transition: transform 0.3s ease;
        opacity: 0.7;
    }

    .lms-topic-header:hover .lms-topic-toggle {
        opacity: 1;
    }

    .lms-topic-collapsed .lms-topic-toggle {
        transform: rotate(-90deg);
    }

    .lms-topic-actions {
        display: flex;
        gap: 0.75rem;
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }

    .lms-topic-header:hover .lms-topic-actions {
        opacity: 1;
    }

    .lms-topic-content {
        padding: 1.5rem;
        background: linear-gradient(to bottom, #fff, rgba(var(--tblr-light-rgb), 0.5));
    }

    .lms-topic-description {
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
        color: var(--tblr-secondary);
        line-height: 1.6;
    }

    .lms-topic-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        background-color: rgba(var(--tblr-light-rgb), 0.5);
        border-top: 1px solid rgba(var(--tblr-secondary-rgb), 0.1);
    }

    /* Toast System */
    .lms-toast-container {
        position: fixed;
        top: 1.5rem;
        right: 1.5rem;
        z-index: 9999;
        max-width: 400px;
        pointer-events: none;
    }

    .lms-toast {
        margin-bottom: 1rem;
        background-color: #fff;
        border-radius: 0.75rem;
        padding: 1.25rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: flex-start;
        border-left: 4px solid var(--tblr-primary);
        opacity: 0;
        transform: translateX(100%) translateY(-100%);
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        pointer-events: auto;
    }

    .lms-toast.show {
        opacity: 1;
        transform: translateX(0) translateY(0);
    }

    .lms-toast-success {
        border-left-color: var(--tblr-success);
        background: linear-gradient(to right, rgba(var(--tblr-success-rgb), 0.05), #fff);
    }

    .lms-toast-error {
        border-left-color: var(--tblr-danger);
        background: linear-gradient(to right, rgba(var(--tblr-danger-rgb), 0.05), #fff);
    }

    .lms-toast-warning {
        border-left-color: var(--tblr-warning);
        background: linear-gradient(to right, rgba(var(--tblr-warning-rgb), 0.05), #fff);
    }

    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .lms-curriculum-container {
            padding: 1rem;
        }

        .lms-empty-state {
            padding: 3rem 1.5rem;
        }

        .lms-empty-state-icon {
            width: 80px;
            height: 80px;
            margin-bottom: 1.5rem;
        }

        .lms-topic-header {
            padding: 1rem;
        }

        .lms-topic-content {
            padding: 1.25rem;
        }

        .lms-topic-footer {
            padding: 1rem;
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .lms-topic-actions {
            flex-wrap: wrap;
            justify-content: flex-end;
        }
    }

    /* LMS System Custom Styles */
    .sortable-ghost {
        opacity: 0.5;
        background: var(--tblr-primary-lt) !important;
    }

    .sortable-drag {
        opacity: 0.9;
        transform: scale(1.02);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .sortable-chosen {
        background: var(--tblr-primary-lt);
    }

    /* Enhanced Form Styles */
    .form-control:focus {
        border-color: var(--tblr-primary);
        box-shadow: 0 0 0 0.25rem rgba(var(--tblr-primary-rgb), 0.1);
    }

    .form-switch .form-check-input:checked {
        background-color: var(--tblr-primary);
        border-color: var(--tblr-primary);
    }

    .form-switch .form-check-input:focus {
        border-color: var(--tblr-primary);
        box-shadow: 0 0 0 0.25rem rgba(var(--tblr-primary-rgb), 0.1);
    }

    /* Custom Button Styles */
    .btn-icon-only {
        width: 2.25rem;
        height: 2.25rem;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.5rem;
    }

    .btn-icon-only.btn-sm {
        width: 1.75rem;
        height: 1.75rem;
    }

    /* Custom Animation Classes */
    .fade-enter {
        opacity: 0;
        transform: translateY(-10px);
    }

    .fade-enter-active {
        opacity: 1;
        transform: translateY(0);
        transition: opacity 300ms ease-in, transform 300ms ease-out;
    }

    .fade-exit {
        opacity: 1;
        transform: translateY(0);
    }

    .fade-exit-active {
        opacity: 0;
        transform: translateY(10px);
        transition: opacity 300ms ease-in, transform 300ms ease-out;
    }

    /* Custom Scrollbar */
    .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: rgba(var(--tblr-primary-rgb), 0.2) transparent;
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: rgba(var(--tblr-primary-rgb), 0.2);
        border-radius: 3px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background-color: rgba(var(--tblr-primary-rgb), 0.4);
    }

    /* Loading States */
    .loading-spinner {
        width: 2.5rem;
        height: 2.5rem;
        border: 3px solid rgba(var(--tblr-primary-rgb), 0.2);
        border-top-color: var(--tblr-primary);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Toast Animations */
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }

        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }

    .toast-enter {
        animation: slideIn 0.3s ease forwards;
    }

    .toast-exit {
        animation: slideOut 0.3s ease forwards;
    }

    /* Responsive Utilities */
    @media (max-width: 767.98px) {
        .hide-on-mobile {
            display: none !important;
        }

        .mobile-full-width {
            width: 100% !important;
        }

        .mobile-stack {
            flex-direction: column !important;
        }

        .mobile-stack>* {
            width: 100% !important;
            margin-bottom: 0.5rem !important;
        }

        .mobile-stack>*:last-child {
            margin-bottom: 0 !important;
        }
    }

    /* Print Styles */
    @media print {
        .no-print {
            display: none !important;
        }

        .print-break-inside-avoid {
            break-inside: avoid;
        }

        .print-break-before {
            break-before: page;
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            {{ __('Add Topic') }}
                        </button>
                    </div>
                </div>

                <div id="lmsCurriculumContainer" class="lms-curriculum-container"
                    data-course-id="{{ $model->id ?? 0 }}">
                    <!-- Empty state - shows when no topics exist -->
                    <div id="lmsEmptyState" class="lms-empty-state" style="display: none;">
                        <div class="lms-empty-state-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book"
                                width="100%" height="100%" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                                <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                                <path d="M3 6l0 13" />
                                <path d="M12 6l0 13" />
                                <path d="M21 6l0 13" />
                            </svg>
                        </div>
                        <h3 class="lms-empty-state-title">{{ __('No Topics Yet') }}</h3>
                        <p class="lms-empty-state-text">
                            {{ __('Start building your course by adding topics. You can then add lessons, quizzes, and assignments to each topic.') }}
                        </p>
                        <button type="button" class="btn btn-primary lms-add-topic-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
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

<!-- Topic Modal with Enhanced UI -->
<div class="modal modal-blur fade" id="topicModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="topicModalTitle">{{ __('Add New Topic') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="topicForm" onsubmit="return false;">
                    <input type="hidden" id="topicId" name="id" value="">
                    <input type="hidden" id="topicCourseId" name="course_id" value="{{ $model->id ?? 0 }}">

                    <div class="mb-3">
                        <label class="form-label required" for="topicTitle">{{ __('Topic Title') }}</label>
                        <input type="text" class="form-control" id="topicTitle" name="title" required>
                        <div class="invalid-feedback" id="topicTitleError"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="topicDescription">{{ __('Description') }}</label>
                        <textarea class="form-control" id="topicDescription" name="description" rows="4"></textarea>
                        <div class="invalid-feedback" id="topicDescriptionError"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="topicOrder">{{ __('Order') }}</label>
                        <input type="number" class="form-control" id="topicOrder" name="order" min="0"
                            value="0">
                        <div class="invalid-feedback" id="topicOrderError"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="topicStatus" name="status"
                                value="publish" checked>
                            <span class="form-check-label">{{ __('Published') }}</span>
                        </label>
                    </div>
                </form>

                <div class="alert alert-danger mt-3" id="topicFormError" style="display: none;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    {{ __('Cancel') }}
                </button>
                <button type="button" class="btn btn-primary ms-auto" id="saveTopic">
                    <span id="saveTopicText">{{ __('Save Topic') }}</span>
                    <span id="saveTopicLoading" style="display: none;">
                        <span class="spinner-border spinner-border-sm me-2" role="status"></span>
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 9l6 6l6 -6" />
                    </svg>
                </span>
                <h5 class="lms-topic-title">{title}</h5>
                <span class="badge bg-{statusBadge} ms-2">{statusText}</span>
            </div>
            <div class="lms-topic-actions">
                <button type="button" class="btn btn-sm btn-icon btn-outline-primary edit-topic-btn"
                    title="{{ __('Edit Topic') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                        <path d="M16 5l3 3" />
                    </svg>
                </button>
                <button type="button" class="btn btn-sm btn-icon btn-outline-danger delete-topic-btn"
                    title="{{ __('Delete Topic') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
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
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
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
                <button type="button" class="btn btn-link link-secondary me-auto"
                    data-bs-dismiss="modal">{{ __('Cancel') }}</button>
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
            if (selectedType === 'lesson') {
                $('#lesson-form').show();
            } else if (selectedType === 'quiz') {
                $('#quiz-form').show();
            } else if (selectedType === 'assignment') {
                $('#assignment-form').show();
            }
        });

        // Toggle between sample curriculum and empty state (for demo purposes)
        // In production, this would check for actual data
        const hasCurriculum = false; // Set to true to see the sample curriculum

        if (hasCurriculum) {
            $('#curriculum-empty-state').hide();
            $('#curriculum-topics').show();
        } else {
            $('#curriculum-empty-state').show();
            $('#curriculum-topics').hide();
        }

        // Lesson type change handler
        $('#lesson-type').change(function() {
            const lessonType = $(this).val();

            if (lessonType === 'document') {
                $('#lesson-content-url').find('small').text(
                    '{{ __('PDF, DOCX, or other document URL') }}');
            } else if (lessonType === 'video') {
                $('#lesson-content-url').find('small').text(
                    '{{ __('YouTube, Vimeo, or direct video file URL') }}');
            } else if (lessonType === 'audio') {
                $('#lesson-content-url').find('small').text(
                    '{{ __('Direct audio file URL or streaming audio URL') }}');
            } else if (lessonType === 'link') {
                $('#lesson-content-url').find('small').text(
                    '{{ __('External website or resource URL') }}');
            }
        });

        // Save Topic Button
        $('#save-topic').click(function() {
            const title = $('#topic-title').val();
            const description = $('#topic-description').val();

            if (!title) {
                alert('{{ __('Please enter a topic title') }}');
                return;
            }

            // Here you would typically save the topic via AJAX
            console.log("Saving topic:", {
                title,
                description
            });

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

            if (itemType === 'lesson') {
                data = {
                    title: $('#lesson-title').val(),
                    type: $('#lesson-type').val(),
                    url: $('#lesson-url').val(),
                    duration: $('#lesson-duration').val(),
                    downloadable: $('#lesson-downloadable').is(':checked'),
                    description: $('#lesson-description').val()
                };
            } else if (itemType === 'quiz') {
                data = {
                    title: $('#quiz-title').val(),
                    timeLimit: $('#quiz-time-limit').val(),
                    passingScore: $('#quiz-passing-score').val(),
                    description: $('#quiz-description').val()
                };
            } else if (itemType === 'assignment') {
                data = {
                    title: $('#assignment-title').val(),
                    instructions: $('#assignment-instructions').val(),
                    dueDays: $('#assignment-due-days').val(),
                    points: $('#assignment-points').val()
                };
            }

            // Validate required fields based on type
            if ((itemType === 'lesson' && !data.title) ||
                (itemType === 'quiz' && !data.title) ||
                (itemType === 'assignment' && !data.title)) {
                alert('{{ __('Please enter a title') }}');
                return;
            }

            // Here you would typically save the item via AJAX
            console.log("Saving curriculum item:", {
                itemType,
                data
            });

            // Clear the form based on type
            if (itemType === 'lesson') {
                $('#lesson-title, #lesson-url, #lesson-duration, #lesson-description').val('');
                $('#lesson-downloadable').prop('checked', false);
            } else if (itemType === 'quiz') {
                $('#quiz-title, #quiz-time-limit, #quiz-passing-score, #quiz-description').val('');
            } else if (itemType === 'assignment') {
                $('#assignment-title, #assignment-instructions, #assignment-due-days, #assignment-points')
                    .val('');
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
                        self.showToast('error', '{{ __('Error') }}',
                            '{{ __('Could not load topics. Please try again.') }}');
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
                const statusText = topic.status === 'publish' ? '{{ __('Published') }}' :
                    '{{ __('Draft') }}';

                return template
                    .replace(/{id}/g, topic.id)
                    .replace(/{title}/g, topic.title)
                    .replace(/{description}/g, topic.description ||
                        '{{ __('No description provided.') }}')
                    .replace(/{order}/g, topic.order)
                    .replace(/{statusBadge}/g, statusBadge)
                    .replace(/{statusText}/g, statusText);
            },

            showAddTopicModal: function() {
                $('#topicModalTitle').text('{{ __('Add New Topic') }}');
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
                    this.showToast('error', '{{ __('Error') }}', '{{ __('Topic not found.') }}');
                    return;
                }

                $('#topicModalTitle').text('{{ __('Edit Topic') }}');
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
                    $('#topicTitleError').text('{{ __('Topic title is required.') }}');
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
                            const index = self.topics.findIndex(t => t.id === parseInt(
                                formData.id));
                            if (index !== -1) {
                                self.topics[index] = response.data;
                            }
                            self.showToast('success', '{{ __('Success') }}',
                                '{{ __('Topic updated successfully.') }}');
                        } else {
                            self.topics.push(response.data);
                            self.showToast('success', '{{ __('Success') }}',
                                '{{ __('Topic created successfully.') }}');
                        }

                        $('#topicModal').modal('hide');
                        self.renderTopics();
                    },
                    error: function(xhr) {
                        const errorMsg = xhr.responseJSON?.message ||
                            '{{ __('Something went wrong. Please try again.') }}';
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
                    this.showToast('error', '{{ __('Error') }}', '{{ __('Topic not found.') }}');
                    return;
                }

                $('#confirmationMessage').html(
                    `{{ __('You are about to delete the topic') }} <strong>${topic.title}</strong>. {{ __('This will also delete all lessons associated with this topic. This action cannot be undone.') }}`
                );

                // Set action for confirmation modal
                $('#confirmAction')
                    .text('{{ __('Yes, delete') }}')
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
                        self.showToast('success', '{{ __('Success') }}',
                            '{{ __('Topic deleted successfully.') }}');
                    },
                    error: function(xhr) {
                        self.showToast('error', '{{ __('Error') }}',
                            '{{ __('Could not delete topic. Please try again.') }}');
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

<!-- option 4 -->
<script>
    $(document).ready(function() {
        class TopicManager {
            constructor() {
                this.state = {
                    topics: [],
                    courseId: null,
                    isLoading: false,
                    currentTopic: null
                };

                this.init();
            }

            init() {
                this.setupEventListeners();
                this.initializeSortable();
                this.loadTopics();
            }

            setupEventListeners() {
                // Add Topic Button
                document.getElementById('addTopicBtn')?.addEventListener('click', () => {
                    this.resetTopicForm();
                    this.openTopicModal();
                });

                // Save Topic Button
                document.getElementById('saveTopic')?.addEventListener('click', () => {
                    this.handleTopicSave();
                });

                // Topic Form
                document.getElementById('topicForm')?.addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.handleTopicSave();
                });

                // Topic Status Toggle
                document.getElementById('topicStatus')?.addEventListener('change', (e) => {
                    if (this.state.currentTopic) {
                        this.updateTopicStatus(this.state.currentTopic.id, e.target.checked ?
                            'publish' : 'draft');
                    }
                });

                // Topic Collapse Toggles
                document.addEventListener('click', (e) => {
                    if (e.target.matches('.lms-topic-toggle')) {
                        const topicEl = e.target.closest('.lms-topic');
                        if (topicEl) {
                            this.toggleTopicCollapse(topicEl);
                        }
                    }
                });

                // Topic Edit Buttons
                document.addEventListener('click', (e) => {
                    if (e.target.matches('.edit-topic-btn')) {
                        const topicId = e.target.dataset.topicId;
                        this.editTopic(topicId);
                    }
                });

                // Topic Delete Buttons
                document.addEventListener('click', (e) => {
                    if (e.target.matches('.delete-topic-btn')) {
                        const topicId = e.target.dataset.topicId;
                        this.deleteTopic(topicId);
                    }
                });
            }

            initializeSortable() {
                const topicsContainer = document.querySelector('.lms-topics-container');
                if (!topicsContainer) return;

                new Sortable(topicsContainer, {
                    animation: 150,
                    handle: '.lms-topic-drag-handle',
                    ghostClass: 'sortable-ghost',
                    chosenClass: 'sortable-chosen',
                    dragClass: 'sortable-drag',
                    onEnd: (evt) => {
                        this.updateTopicOrder(evt.oldIndex, evt.newIndex);
                    }
                });
            }

            async loadTopics() {
                try {
                    this.setState({
                        isLoading: true
                    });
                    const courseId = document.getElementById('topicCourseId')?.value;
                    if (!courseId) throw new Error('Course ID not found');

                    const response = await fetch(`/admin/lms/courses/${courseId}/topics`);
                    if (!response.ok) throw new Error('Failed to load topics');

                    const data = await response.json();
                    this.setState({
                        topics: data.topics || [],
                        courseId
                    });

                    this.renderTopics();
                } catch (error) {
                    this.showToast('error', 'Error', error.message);
                } finally {
                    this.setState({
                        isLoading: false
                    });
                }
            }

            async handleTopicSave() {
                try {
                    const form = document.getElementById('topicForm');
                    if (!form) throw new Error('Form not found');

                    const formData = new FormData(form);
                    const topicId = formData.get('id');
                    const courseId = formData.get('course_id');

                    this.setState({
                        isLoading: true
                    });

                    const url = topicId ?
                        `/admin/lms/topics/${topicId}` :
                        `/admin/lms/courses/${courseId}/topics`;

                    const response = await fetch(url, {
                        method: topicId ? 'PUT' : 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                ?.content
                        }
                    });

                    if (!response.ok) throw new Error('Failed to save topic');

                    const data = await response.json();

                    if (topicId) {
                        this.updateTopicInState(data.topic);
                    } else {
                        this.addTopicToState(data.topic);
                    }

                    this.closeTopicModal();
                    this.showToast('success', 'Success', data.message || 'Topic saved successfully');
                } catch (error) {
                    this.showToast('error', 'Error', error.message);
                } finally {
                    this.setState({
                        isLoading: false
                    });
                }
            }

            async deleteTopic(topicId) {
                if (!confirm('Are you sure you want to delete this topic?')) return;

                try {
                    this.setState({
                        isLoading: true
                    });

                    const response = await fetch(`/admin/lms/topics/${topicId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                ?.content
                        }
                    });

                    if (!response.ok) throw new Error('Failed to delete topic');

                    const data = await response.json();
                    this.removeTopicFromState(topicId);
                    this.showToast('success', 'Success', data.message || 'Topic deleted successfully');
                } catch (error) {
                    this.showToast('error', 'Error', error.message);
                } finally {
                    this.setState({
                        isLoading: false
                    });
                }
            }

            async updateTopicOrder(oldIndex, newIndex) {
                if (oldIndex === newIndex) return;

                try {
                    const topics = [...this.state.topics];
                    const [movedTopic] = topics.splice(oldIndex, 1);
                    topics.splice(newIndex, 0, movedTopic);

                    const orderedIds = topics.map((topic, index) => ({
                        id: topic.id,
                        order: index
                    }));

                    this.setState({
                        topics
                    });

                    const response = await fetch('/admin/lms/topics/reorder', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                ?.content
                        },
                        body: JSON.stringify({
                            topics: orderedIds
                        })
                    });

                    if (!response.ok) throw new Error('Failed to update topic order');

                    const data = await response.json();
                    this.showToast('success', 'Success', data.message || 'Topic order updated');
                } catch (error) {
                    this.showToast('error', 'Error', error.message);
                    this.loadTopics(); // Reload topics to restore original order
                }
            }

            // State Management Methods
            setState(newState) {
                this.state = {
                    ...this.state,
                    ...newState
                };
                this.updateUI();
            }

            addTopicToState(topic) {
                this.setState({
                    topics: [...this.state.topics, topic]
                });
            }

            updateTopicInState(updatedTopic) {
                this.setState({
                    topics: this.state.topics.map(topic =>
                        topic.id === updatedTopic.id ? updatedTopic : topic
                    )
                });
            }

            removeTopicFromState(topicId) {
                this.setState({
                    topics: this.state.topics.filter(topic => topic.id !== topicId)
                });
            }

            // UI Methods
            updateUI() {
                this.renderTopics();
                this.updateLoadingState();
            }

            renderTopics() {
                const container = document.querySelector('.lms-topics-container');
                if (!container) return;

                if (this.state.topics.length === 0) {
                    container.innerHTML = this.getEmptyStateHTML();
                    return;
                }

                container.innerHTML = this.state.topics
                    .map(topic => this.getTopicHTML(topic))
                    .join('');
            }

            getEmptyStateHTML() {
                return `
            <div class="lms-empty-state">
                <div class="lms-empty-state-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                        <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                        <path d="M3 6l0 13"></path>
                        <path d="M12 6l0 13"></path>
                        <path d="M21 6l0 13"></path>
                    </svg>
                </div>
                <h3 class="lms-empty-state-title">No Topics Yet</h3>
                <p class="lms-empty-state-text">Start creating topics to organize your course content. Click the "Add Topic" button to get started.</p>
                <button type="button" class="btn btn-primary" id="addTopicBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 5l0 14"></path>
                        <path d="M5 12l14 0"></path>
                    </svg>
                    Add First Topic
                </button>
            </div>
        `;
            }

            getTopicHTML(topic) {
                return `
            <div class="lms-topic" data-topic-id="${topic.id}">
                <div class="lms-topic-header">
                    <div class="lms-topic-title-wrapper">
                        <span class="lms-topic-drag-handle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-grip-vertical" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M9 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M9 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M15 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M15 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M15 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                            </svg>
                        </span>
                        <h3 class="lms-topic-title">${this.escapeHtml(topic.title)}</h3>
                        <span class="badge bg-${topic.status === 'publish' ? 'success' : 'warning'} ms-2">
                            ${topic.status === 'publish' ? 'Published' : 'Draft'}
                        </span>
                    </div>
                    <div class="lms-topic-actions">
                        <button type="button" class="btn btn-icon btn-light edit-topic-btn" data-topic-id="${topic.id}" title="Edit Topic">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                            </svg>
                        </button>
                        <button type="button" class="btn btn-icon btn-light delete-topic-btn" data-topic-id="${topic.id}" title="Delete Topic">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
        `;
            }

            updateLoadingState() {
                const saveButton = document.getElementById('saveTopic');
                const saveText = document.getElementById('saveTopicText');
                const saveLoading = document.getElementById('saveTopicLoading');

                if (this.state.isLoading) {
                    saveButton?.setAttribute('disabled', 'disabled');
                    saveText?.style.setProperty('display', 'none');
                    saveLoading?.style.setProperty('display', 'inline-block');
                } else {
                    saveButton?.removeAttribute('disabled');
                    saveText?.style.setProperty('display', 'inline-block');
                    saveLoading?.style.setProperty('display', 'none');
                }
            }

            // Modal Methods
            openTopicModal() {
                const modal = document.getElementById('topicModal');
                if (!modal) return;

                const bsModal = new bootstrap.Modal(modal);
                bsModal.show();
            }

            closeTopicModal() {
                const modal = document.getElementById('topicModal');
                if (!modal) return;

                const bsModal = bootstrap.Modal.getInstance(modal);
                if (bsModal) {
                    bsModal.hide();
                }
            }

            resetTopicForm() {
                const form = document.getElementById('topicForm');
                if (!form) return;

                form.reset();
                form.querySelector('#topicId').value = '';
                this.setState({
                    currentTopic: null
                });

                // Clear validation errors
                form.querySelectorAll('.is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });
                form.querySelectorAll('.invalid-feedback').forEach(el => {
                    el.textContent = '';
                });
            }

            // Toast Methods
            showToast(type, title, message) {
                const toastContainer = document.querySelector('.lms-toast-container');
                if (!toastContainer) {
                    const container = document.createElement('div');
                    container.className = 'lms-toast-container';
                    document.body.appendChild(container);
                }

                const toast = document.createElement('div');
                toast.className = `lms-toast lms-toast-${type}`;
                toast.innerHTML = `
            <div class="lms-toast-content">
                <h4 class="mb-1">${this.escapeHtml(title)}</h4>
                <div>${this.escapeHtml(message)}</div>
            </div>
        `;

                toastContainer.appendChild(toast);
                requestAnimationFrame(() => toast.classList.add('show'));

                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => toast.remove(), 300);
                }, 3000);
            }

            // Utility Methods
            escapeHtml(unsafe) {
                return unsafe
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }
        }

        // Initialize Topic Manager when DOM is ready
        document.addEventListener('DOMContentLoaded', () => {
            new TopicManager();
        });
    });
</script>
