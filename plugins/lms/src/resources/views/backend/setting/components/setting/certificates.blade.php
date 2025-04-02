<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Certificate Settings') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure certificate generation and issuance settings.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable Certificates', 'lms_enable_certificates', [
                        'value' => get_config('lms_enable_certificates', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Allow certificates to be issued upon course completion.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                {{ Field::select('Certificate Template', 'lms_certificate_template', [
                    'value' => get_config('lms_certificate_template', 'default'),
                    'options' => [
                        'default' => __('Default Template'),
                        'professional' => __('Professional Template'),
                        'minimal' => __('Minimal Template'),
                    ],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('Default template style for certificates.') }}</small>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                {{ Field::image('Certificate Logo', 'lms_certificate_logo', [
                    'value' => get_config('lms_certificate_logo'),
                    'class' => 'form-control',
                ]) }}
                <small class="form-text text-muted">{{ __('Logo to display on certificates.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::image('Certificate Signature', 'lms_certificate_signature', [
                    'value' => get_config('lms_certificate_signature'),
                    'class' => 'form-control',
                ]) }}
                <small class="form-text text-muted">{{ __('Signature image to display on certificates.') }}</small>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Certificate Content') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure the text content that appears on certificates.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ Field::text('Certificate Title', 'lms_certificate_title', [
                    'value' => get_config('lms_certificate_title', 'Certificate of Completion'),
                    'class' => 'form-control',
                ]) }}
                <small class="form-text text-muted">{{ __('Title displayed at the top of certificates.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::text('Certificate Issuer Name', 'lms_certificate_issuer', [
                    'value' => get_config('lms_certificate_issuer', get_config('title')),
                    'class' => 'form-control',
                ]) }}
                <small class="form-text text-muted">{{ __('Name of the organization issuing certificates.') }}</small>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                {{ Field::textarea('Certificate Text Template', 'lms_certificate_text', [
                    'value' => get_config('lms_certificate_text', 'This is to certify that {student_name} has successfully completed the course {course_name} on {completion_date}.'),
                    'class' => 'form-control',
                    'rows' => 3,
                ]) }}
                <small class="form-text text-muted">
                    {{ __('Text template for certificates. Available variables: {student_name}, {course_name}, {completion_date}, {instructor_name}') }}
                </small>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Certificate Verification') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure how certificates can be verified.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable Certificate Verification', 'lms_enable_certificate_verification', [
                        'value' => get_config('lms_enable_certificate_verification', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Allow certificates to be verified through a public URL.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Show QR Code on Certificates', 'lms_show_certificate_qr', [
                        'value' => get_config('lms_show_certificate_qr', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Display a QR code on certificates for easy verification.') }}</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {{ Field::text('Certificate Verification Text', 'lms_certificate_verification_text', [
                    'value' => get_config('lms_certificate_verification_text', 'Verify the authenticity of this certificate at: {verification_url}'),
                    'class' => 'form-control',
                ]) }}
                <small class="form-text text-muted">{{ __('Text displayed for certificate verification. {verification_url} will be replaced with the actual URL.') }}</small>
            </div>
        </div>
    </div>
</div> 