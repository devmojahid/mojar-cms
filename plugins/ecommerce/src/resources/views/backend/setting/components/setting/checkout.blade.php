<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Checkout Options') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure how the checkout process works.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Enable Guest Checkout'), '_enable_guest_checkout', [
                        'value' => get_config('_enable_guest_checkout', 0),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Allow customers to checkout without creating an account.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Enable Coupons'), '_enable_coupons', [
                        'value' => get_config('_enable_coupons', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Allow customers to use coupon codes at checkout.') }}</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Force Secure Checkout'), '_force_secure_checkout', [
                        'value' => get_config('_force_secure_checkout', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Force HTTPS on checkout pages.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Display Return to Shop Button'), '_show_return_to_shop', [
                        'value' => get_config('_show_return_to_shop', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Display a "Return to Shop" button on the cart page.') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Customer Information') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure what information is required from customers during checkout.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Require Phone Number'), '_require_phone', [
                        'value' => get_config('_require_phone', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Require customers to provide a phone number during checkout.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Require Shipping Address'), '_require_shipping_address', [
                        'value' => get_config('_require_shipping_address', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Require customers to provide a shipping address during checkout.') }}</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Allow Address Editing'), '_allow_address_editing', [
                        'value' => get_config('_allow_address_editing', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Allow customers to edit their addresses after placing an order.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Display Order Notes Field'), '_enable_order_notes', [
                        'value' => get_config('_enable_order_notes', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Allow customers to add notes to their orders.') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Order Processing') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure what happens after an order is placed.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ Field::select(__('Default Order Status'), '_default_order_status', [
                    'value' => get_config('_default_order_status', 'pending'),
                    'options' => [
                        'pending' => __('Pending'),
                        'processing' => __('Processing'),
                        'on-hold' => __('On Hold'),
                    ],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('Status assigned to new orders.') }}</small>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Create Customer Account on Order'), '_create_account_on_order', [
                        'value' => get_config('_create_account_on_order', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Automatically create an account for guest customers when they place an order.') }}</small>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Redirect to Thank You Page'), '_redirect_to_thank_you', [
                        'value' => get_config('_redirect_to_thank_you', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Redirect customers to the thank you page after checkout.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Enable Order Tracking'), '_enable_order_tracking', [
                        'value' => get_config('_enable_order_tracking', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Allow customers to track their orders.') }}</small>
                </div>
            </div>
        </div>
    </div>
</div> 