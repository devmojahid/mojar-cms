<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Student Registration') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure student registration and account settings.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable Student Registration', 'lms_student_registration', [
                        'value' => get_config('lms_student_registration', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Allow users to register as students on the site.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                {{ Field::select('Default Student Role', 'lms_student_role', [
                    'value' => get_config('lms_student_role', 'subscriber'),
                    'options' => $roles ?? [
                        'subscriber' => 'Subscriber',
                        'customer' => 'Customer',
                    ],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('Role assigned to new student registrations.') }}</small>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Auto-Approve Student Accounts', 'lms_auto_approve_students', [
                        'value' => get_config('lms_auto_approve_students', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Automatically approve new student registrations.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Require Email Verification', 'lms_require_email_verification', [
                        'value' => get_config('lms_require_email_verification', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Require email verification for new student accounts.') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Student Learning Experience') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure settings related to student learning experience.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable Progress Tracking', 'lms_progress_tracking', [
                        'value' => get_config('lms_progress_tracking', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Track student progress through courses.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Auto-Complete Lessons', 'lms_auto_complete_lesson', [
                        'value' => get_config('lms_auto_complete_lesson', 0),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Automatically mark lessons as complete when viewed.') }}</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable Course Reviews', 'lms_enable_reviews', [
                        'value' => get_config('lms_enable_reviews', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Allow students to leave reviews for courses.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable Course Wishlist', 'lms_enable_wishlist', [
                        'value' => get_config('lms_enable_wishlist', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Allow students to add courses to their wishlist.') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Student Course Access') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure how students access and interact with courses.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ Field::text('Course Access Duration (Days)', 'lms_course_access_duration', [
                    'value' => get_config('lms_course_access_duration', 365),
                    'class' => 'form-control',
                    'min' => 0,
                ]) }}
                <small class="form-text text-muted">{{ __('How long students can access a course after enrollment (0 for unlimited).') }}</small>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Allow Course Refunds', 'lms_allow_course_refunds', [
                        'value' => get_config('lms_allow_course_refunds', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Allow students to request refunds for purchased courses.') }}</small>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                {{ Field::text('Refund Policy Time Limit (Days)', 'lms_refund_policy_days', [
                    'value' => get_config('lms_refund_policy_days', 30),
                    'class' => 'form-control',
                    'min' => 0,
                ]) }}
                <small class="form-text text-muted">{{ __('Number of days after purchase that students can request a refund.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::text('Maximum Course Completion Percentage for Refund', 'lms_refund_max_completion', [
                    'value' => get_config('lms_refund_max_completion', 25),
                    'class' => 'form-control',
                    'min' => 0,
                    'max' => 100,
                ]) }}
                <small class="form-text text-muted">{{ __('Maximum percentage of course completion allowed for refund eligibility.') }}</small>
            </div>
        </div>
    </div>
</div> 