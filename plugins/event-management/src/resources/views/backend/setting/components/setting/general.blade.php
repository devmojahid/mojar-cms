<style>
    .event-settings .card-title {
        margin-right: 5px;
    }
</style>

<div class="card mb-4 d-none">
    <div class="card-header">
        <h5 class="card-title">{{ trans('evman::content.store_address') }} </h5>
        <div class="card-subtitle">
            {{ __('This is where your business is located. It will be used for invoices and notifications.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ Field::text('Store Address 1', 'evman_store_address1', [
                    'value' => get_config('evman_store_address1'),
                    'class' => 'form-control',
                ]) }}
            </div>
            <div class="col-md-6">
                {{ Field::text('Store Address 2', 'evman_store_address2', [
                    'value' => get_config('evman_store_address2'),
                    'class' => 'form-control',
                ]) }}
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                {{ Field::text('City', 'evman_city', [
                    'value' => get_config('evman_city'),
                    'class' => 'form-control',
                ]) }}
            </div>
            <div class="col-md-4">
                {{ Field::select('Country', 'evman_country', [
                    'value' => get_config('evman_country'),
                    'options' => $countries ?? [],
                    'class' => 'form-select',
                ]) }}
            </div>
            <div class="col-md-4">
                {{ Field::text('Postcode / ZIP', 'evman_zipcode', [
                    'value' => get_config('evman_zipcode'),
                    'class' => 'form-control',
                ]) }}
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Event Settings') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure default settings for events and tickets') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ Field::select('Default Event Status', 'evman_event_default_status', [
                    'value' => get_config('evman_event_default_status', 'active'),
                    'options' => [
                        'active' => __('Active'),
                        'inactive' => __('Inactive'),
                        'draft' => __('Draft'),
                    ],
                    'class' => 'form-select',
                ]) }}
            </div>
            <div class="col-md-6">
                {{ Field::select('Default Ticket Status', 'evman_ticket_default_status', [
                    'value' => get_config('evman_ticket_default_status', 'active'),
                    'options' => [
                        'active' => __('Active'),
                        'inactive' => __('Inactive'),
                    ],
                    'class' => 'form-select',
                ]) }}
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                {{ Field::text('Ticket Code Prefix', 'evman_ticket_prefix', [
                    'value' => get_config('evman_ticket_prefix', 'EVT-'),
                    'class' => 'form-control',
                ]) }}
            </div>
            <div class="col-md-6">
                {{ Field::text('Booking Expiry Time (minutes)', 'evman_booking_expiry_time', [
                    'value' => get_config('evman_booking_expiry_time', 30),
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 1440,
                ]) }}
            </div>
        </div>
    </div>
</div>
