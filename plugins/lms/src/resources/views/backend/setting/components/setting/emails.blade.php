<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Email Notification Settings') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure email notifications for various LMS events.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('New Course Notification', 'lms_email_new_course', [
                        'value' => get_config('lms_email_new_course', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Send email notification to admin when a new course is created.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Course Completion Email', 'lms_email_course_completion', [
                        'value' => get_config('lms_email_course_completion', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Send email to student when they complete a course.') }}</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enrollment Confirmation Email', 'lms_email_enrollment', [
                        'value' => get_config('lms_email_enrollment', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Send email confirmation when a student enrolls in a course.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Instructor Application Email', 'lms_email_instructor_application', [
                        'value' => get_config('lms_email_instructor_application', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Send email to admin when someone applies to become an instructor.') }}</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('New Lesson Email', 'lms_email_new_lesson', [
                        'value' => get_config('lms_email_new_lesson', 0),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Send email to enrolled students when a new lesson is published.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Student Quiz Result Email', 'lms_email_quiz_result', [
                        'value' => get_config('lms_email_quiz_result', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Send email to student with their quiz results.') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>