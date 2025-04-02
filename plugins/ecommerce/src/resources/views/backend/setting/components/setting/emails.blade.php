<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Email Notification Settings') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure email notifications for various ecommerce events.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('New Order Email'), '_email_new_order', [
                        'value' => get_config('_email_new_order', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Send email notification to admin when a new order is placed.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Processing Order Email'), '_email_processing_order', [
                        'value' => get_config('_email_processing_order', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Send email to customer when their order status changes to processing.') }}</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Completed Order Email'), '_email_completed_order', [
                        'value' => get_config('_email_completed_order', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Send email to customer when their order is completed.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Cancelled Order Email'), '_email_cancelled_order', [
                        'value' => get_config('_email_cancelled_order', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Send email to customer when their order is cancelled.') }}</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Failed Order Email'), '_email_failed_order', [
                        'value' => get_config('_email_failed_order', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Send email to customer when their order failed.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Customer Invoice Email'), '_email_customer_invoice', [
                        'value' => get_config('_email_customer_invoice', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Send invoice email to customer.') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Email Sender Settings') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure the sender information for ecommerce emails.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ Field::text(__('Sender Name'), '_email_sender_name', [
                    'value' => get_config('_email_sender_name', get_config('title')),
                    'class' => 'form-control',
                ]) }}
                <small class="form-text text-muted">{{ __('Name displayed as the email sender.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::text(__('Sender Email'), '_email_sender_address', [
                    'value' => get_config('_email_sender_address', get_config('sender_email')),
                    'class' => 'form-control',
                ]) }}
                <small class="form-text text-muted">{{ __('Email address used as the sender address.') }}</small>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Email Templates') }}</h5>
        <div class="card-subtitle">
            {{ __('Customize email templates for different notifications.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <label class="form-label">{{ __('New Order Email Template') }}</label>
            {{ Field::textarea('', '_email_new_order_template', [
                'value' => get_config('_email_new_order_template', "Hello {customer_name},\n\nThank you for your order. Your order #{order_number} has been received and is now being processed.\n\nYou can view your order details by logging into your account.\n\nThank you for shopping with us!"),
                'class' => 'form-control',
                'rows' => 5,
            ]) }}
            <small class="form-text text-muted">
                {{ __('Available variables: {customer_name}, {order_number}, {order_date}, {order_total}, {payment_method}, {shipping_method}') }}
            </small>
        </div>

        <div class="mb-4">
            <label class="form-label">{{ __('Completed Order Email Template') }}</label>
            {{ Field::textarea('', '_email_completed_order_template', [
                'value' => get_config('_email_completed_order_template', "Hello {customer_name},\n\nYour order #{order_number} has been completed and shipped.\n\nIf you have any questions about your order, please contact us.\n\nThank you for shopping with us!"),
                'class' => 'form-control',
                'rows' => 5,
            ]) }}
            <small class="form-text text-muted">
                {{ __('Available variables: {customer_name}, {order_number}, {order_date}, {order_total}, {payment_method}, {shipping_method}, {tracking_number}') }}
            </small>
        </div>

        <div class="mb-4">
            <label class="form-label">{{ __('Invoice Email Template') }}</label>
            {{ Field::textarea('', '_email_invoice_template', [
                'value' => get_config('_email_invoice_template', "Hello {customer_name},\n\nYour invoice for order #{order_number} is attached to this email.\n\nIf you have any questions about your invoice, please contact us.\n\nThank you for shopping with us!"),
                'class' => 'form-control',
                'rows' => 5,
            ]) }}
            <small class="form-text text-muted">
                {{ __('Available variables: {customer_name}, {order_number}, {order_date}, {order_total}, {payment_method}, {payment_status}') }}
            </small>
        </div>
    </div>
</div> 