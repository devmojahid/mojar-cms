<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Course Display Settings') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure how courses are displayed and accessed by students.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ Field::select('Default Course Status', 'lms_default_course_status', [
                    'value' => get_config('lms_default_course_status', 'draft'),
                    'options' => [
                        'publish' => __('Published'),
                        'draft' => __('Draft'),
                        'pending' => __('Pending Review'),
                    ],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('Default status for newly created courses.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::text('Course Permalink Base', 'lms_course_permalink_base', [
                    'value' => get_config('lms_course_permalink_base', 'course'),
                    'class' => 'form-control',
                ]) }}
                <small class="form-text text-muted">{{ __('Base slug used in course URLs (e.g., example.com/course/course-name).') }}</small>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                {{ Field::select('Default Course Access Mode', 'lms_course_access_mode', [
                    'value' => get_config('lms_course_access_mode', 'open'),
                    'options' => [
                        'open' => __('Open Access'),
                        'paid' => __('Paid Access'),
                        'restricted' => __('Restricted Access'),
                    ],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('Default access mode for new courses.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::select('Course Content Display', 'lms_course_display_mode', [
                    'value' => get_config('lms_course_display_mode', 'all'),
                    'options' => [
                        'all' => __('Show All Lessons'),
                        'sequential' => __('Sequential Access'),
                    ],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('How course content is displayed to students.') }}</small>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Course Features') }}</h5>
        <div class="card-subtitle">
            {{ __('Enable or disable various course features.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <div class="form-check form-switch">
                        {{ Field::checkbox('Enable Course Reviews', 'lms_enable_course_reviews', [
                            'value' => get_config('lms_enable_course_reviews', 1),
                            'class' => 'form-check-input',
                        ]) }}
                        <small class="form-text text-muted">{{ __('Allow students to leave reviews for courses.') }}</small>
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="form-check form-switch">
                        {{ Field::checkbox('Enable Course Progress Tracking', 'lms_enable_course_progress', [
                            'value' => get_config('lms_enable_course_progress', 1),
                            'class' => 'form-check-input',
                        ]) }}
                        <small class="form-text text-muted">{{ __('Track student progress through courses.') }}</small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="mb-3">
                    <div class="form-check form-switch">
                        {{ Field::checkbox('Enable Course Discussions', 'lms_enable_course_discussions', [
                            'value' => get_config('lms_enable_course_discussions', 1),
                            'class' => 'form-check-input',
                        ]) }}
                        <small class="form-text text-muted">{{ __('Allow discussions within courses.') }}</small>
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="form-check form-switch">
                        {{ Field::checkbox('Enable Course Prerequisites', 'lms_enable_course_prerequisites', [
                            'value' => get_config('lms_enable_course_prerequisites', 0),
                            'class' => 'form-check-input',
                        ]) }}
                        <small class="form-text text-muted">{{ __('Allow courses to require completion of other courses first.') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Course Content Settings') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure settings for lessons, quizzes, and other course content.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ Field::select('Default Video Player', 'lms_default_video_player', [
                    'value' => get_config('lms_default_video_player', 'native'),
                    'options' => [
                        'native' => __('Browser Native Player'),
                        'plyr' => __('Plyr Player'),
                        'videojs' => __('Video.js Player'),
                    ],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('Default video player for course video content.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::select('Quiz Passing Grade', 'lms_quiz_passing_grade', [
                    'value' => get_config('lms_quiz_passing_grade', '70'),
                    'options' => [
                        '50' => '50%',
                        '60' => '60%',
                        '70' => '70%',
                        '80' => '80%',
                        '90' => '90%',
                    ],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('Default passing grade percentage for quizzes.') }}</small>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                {{ Field::text('Maximum Quiz Attempts', 'lms_max_quiz_attempts', [
                    'value' => get_config('lms_max_quiz_attempts', 3),
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 10,
                ]) }}
                <small class="form-text text-muted">{{ __('Maximum number of attempts allowed for quizzes.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::text('Auto-Complete Video After Percentage', 'lms_auto_complete_video_percentage', [
                    'value' => get_config('lms_auto_complete_video_percentage', 90),
                    'class' => 'form-control',
                    'min' => 0,
                    'max' => 100,
                ]) }}
                <small class="form-text text-muted">{{ __('Mark videos as completed after watching this percentage. Set to 100 to require full viewing.') }}</small>
            </div>
        </div>
    </div>
</div> 