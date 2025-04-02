<style>
    .lms-settings .card-title {
        margin-right: 5px;
    }
</style>

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
 
 <div class="card mb-4 d-none">
    <div class="card-header">
        <h5 class="card-title">{{ trans('lms::content.store_address') }}</h5>
        <div class="card-subtitle">
            {{ __('This is where your business is located. This address will be used on invoices and for tax calculations.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ Field::text('Store Address 1', '_store_address1', [
                    'value' => get_config('_store_address1'),
                    'class' => 'form-control',
                ]) }}
            </div>
            <div class="col-md-6">
                {{ Field::text('Store Address 2', '_store_address2', [
                    'value' => get_config('_store_address2'),
                    'class' => 'form-control',
                ]) }}
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                {{ Field::text('City', '_city', [
                    'value' => get_config('_city'),
                    'class' => 'form-control',
                ]) }}
            </div>
            <div class="col-md-4">
                {{ Field::select('Country', '_country', [
                    'value' => get_config('_country'),
                    'options' => $countries ?? [],
                    'class' => 'form-select',
                ]) }}
            </div>
            <div class="col-md-4">
                {{ Field::text('Postcode / ZIP', '_zipcode', [
                    'value' => get_config('_zipcode'),
                    'class' => 'form-control',
                ]) }}
            </div>
        </div>
    </div>
</div>


<div class="card mb-4 d-none">
    <div class="card-header">
        <h5 class="card-title">{{ __('Currency Settings') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure how prices and currencies are displayed on your LMS.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ Field::select('Currency', 'lms_currency', [
                    'value' => get_config('lms_currency', 'USD'),
                    'options' => [
                        'USD' => 'US Dollar ($)',
                        'EUR' => 'Euro (€)',
                        'GBP' => 'British Pound (£)',
                        'JPY' => 'Japanese Yen (¥)',
                        'INR' => 'Indian Rupee (₹)',
                        'CAD' => 'Canadian Dollar (C$)',
                        'AUD' => 'Australian Dollar (A$)',
                        'SGD' => 'Singapore Dollar (S$)',
                    ],
                    'class' => 'form-select',
                ]) }}
            </div>
            <div class="col-md-6">
                {{ Field::select('Currency Position', 'lms_currency_position', [
                    'value' => get_config('lms_currency_position', 'left'),
                    'options' => [
                        'left' => 'Left ($99.99)',
                        'right' => 'Right (99.99$)',
                        'left_space' => 'Left with space ($ 99.99)',
                        'right_space' => 'Right with space (99.99 $)',
                    ],
                    'class' => 'form-select',
                ]) }}
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                {{ Field::text('Thousand Separator', 'lms_thousand_separator', [
                    'value' => get_config('lms_thousand_separator', ','),
                    'class' => 'form-control',
                ]) }}
            </div>
            <div class="col-md-4">
                {{ Field::text('Decimal Separator', 'lms_decimal_separator', [
                    'value' => get_config('lms_decimal_separator', '.'),
                    'class' => 'form-control',
                ]) }}
            </div>
            <div class="col-md-4">
                {{ Field::select('Number of Decimals', 'lms_number_of_decimals', [
                    'value' => get_config('lms_number_of_decimals', '2'),
                    'options' => [
                        '0' => '0',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                    ],
                    'class' => 'form-select',
                ]) }}
            </div>
        </div>
    </div>
</div> 