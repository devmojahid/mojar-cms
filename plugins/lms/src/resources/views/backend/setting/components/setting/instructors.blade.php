<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Instructor Registration') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure instructor registration and approval settings.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Allow Instructor Applications', 'lms_instructor_application', [
                        'value' => get_config('lms_instructor_application', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Allow users to apply to become instructors.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Auto-Approve Instructor Applications', 'lms_auto_approve_instructor', [
                        'value' => get_config('lms_auto_approve_instructor', 0),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Automatically approve new instructor applications.') }}</small>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                {{ Field::textarea('Instructor Application Instructions', 'lms_instructor_application_instructions', [
                    'value' => get_config('lms_instructor_application_instructions', 'Please provide information about your teaching experience and expertise. We review all applications and will notify you of our decision.'),
                    'class' => 'form-control',
                    'rows' => 3,
                ]) }}
                <small class="form-text text-muted">{{ __('Instructions shown to users applying to become instructors.') }}</small>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Instructor Commission Settings') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure how instructors earn from their courses.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ Field::text('Default Instructor Commission (%)', 'lms_instructor_commission', [
                    'value' => get_config('lms_instructor_commission', 70),
                    'class' => 'form-control',
                    'min' => 0,
                    'max' => 100,
                ]) }}
                <small class="form-text text-muted">{{ __('Default percentage of course sales that goes to instructors.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::select('Commission Calculation', 'lms_instructor_commission_type', [
                    'value' => get_config('lms_instructor_commission_type', 'percentage'),
                    'options' => [
                        'percentage' => __('Percentage of Sale'),
                        'fixed' => __('Fixed Amount per Sale'),
                    ],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('How instructor commissions are calculated.') }}</small>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                {{ Field::text('Minimum Payout Amount', 'lms_minimum_payout', [
                    'value' => get_config('lms_minimum_payout', 50),
                    'class' => 'form-control',
                    'min' => 0,
                ]) }}
                <small class="form-text text-muted">{{ __('Minimum amount required before processing instructor payouts.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::select('Payout Schedule', 'lms_payout_schedule', [
                    'value' => get_config('lms_payout_schedule', 'monthly'),
                    'options' => [
                        'weekly' => __('Weekly'),
                        'biweekly' => __('Bi-Weekly'),
                        'monthly' => __('Monthly'),
                        'quarterly' => __('Quarterly'),
                    ],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('How often instructor payouts are processed.') }}</small>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Instructor Capabilities') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure what instructors can do on the platform.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Instructors Can Add Students', 'lms_instructors_can_add_students', [
                        'value' => get_config('lms_instructors_can_add_students', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Allow instructors to manually add students to their courses.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Instructors Can Remove Students', 'lms_instructors_can_remove_students', [
                        'value' => get_config('lms_instructors_can_remove_students', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Allow instructors to remove students from their courses.') }}</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Instructors Can Create Coupons', 'lms_instructors_can_create_coupons', [
                        'value' => get_config('lms_instructors_can_create_coupons', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Allow instructors to create discount coupons for their courses.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Instructors Can Issue Certificates', 'lms_instructors_can_issue_certificates', [
                        'value' => get_config('lms_instructors_can_issue_certificates', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Allow instructors to issue certificates to their students.') }}</small>
                </div>
            </div>
        </div>
    </div>
</div> 