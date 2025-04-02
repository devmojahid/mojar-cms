<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('LMS Pages') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure the pages used for various LMS features.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ Field::select('Courses Page', 'lms_courses_page', [
                    'value' => get_config('lms_courses_page'),
                    'options' => $pages ?? [],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('The main page that displays all courses.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::select('My Courses Page', 'lms_my_courses_page', [
                    'value' => get_config('lms_my_courses_page'),
                    'options' => $pages ?? [],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('The page that displays enrolled courses for logged-in students.') }}</small>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                {{ Field::select('Checkout Page', 'lms_checkout_page', [
                    'value' => get_config('lms_checkout_page'),
                    'options' => $pages ?? [],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('The page used for course checkout process.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::select('Thank You Page', 'lms_thank_you_page', [
                    'value' => get_config('lms_thank_you_page'),
                    'options' => $pages ?? [],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('The page displayed after successful course purchase.') }}</small>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                {{ Field::select('Become Instructor Page', 'lms_instructor_page', [
                    'value' => get_config('lms_instructor_page'),
                    'options' => $pages ?? [],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('The page with the instructor application form.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::select('Student Dashboard Page', 'lms_student_dashboard_page', [
                    'value' => get_config('lms_student_dashboard_page'),
                    'options' => $pages ?? [],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('The main dashboard page for students.') }}</small>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('URL Slugs') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure the URL structure for LMS content.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ Field::text('Course Base Slug', 'lms_course_base_slug', [
                    'value' => get_config('lms_course_base_slug', 'courses'),
                    'class' => 'form-control',
                ]) }}
                <small class="form-text text-muted">{{ __('Base slug for course URLs (example.com/courses/course-name).') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::text('Lesson Base Slug', 'lms_lesson_base_slug', [
                    'value' => get_config('lms_lesson_base_slug', 'lesson'),
                    'class' => 'form-control',
                ]) }}
                <small class="form-text text-muted">{{ __('Base slug for lesson URLs (example.com/courses/course-name/lesson/lesson-name).') }}</small>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                {{ Field::text('Quiz Base Slug', 'lms_quiz_base_slug', [
                    'value' => get_config('lms_quiz_base_slug', 'quiz'),
                    'class' => 'form-control',
                ]) }}
                <small class="form-text text-muted">{{ __('Base slug for quiz URLs (example.com/courses/course-name/quiz/quiz-name).') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::text('Certificate Verification Slug', 'lms_certificate_verification_slug', [
                    'value' => get_config('lms_certificate_verification_slug', 'verify-certificate'),
                    'class' => 'form-control',
                ]) }}
                <small class="form-text text-muted">{{ __('Slug for certificate verification page (example.com/verify-certificate/CERTIFICATE-ID).') }}</small>
            </div>
        </div>
    </div>
</div>
