<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Shop Pages') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure the pages used for various ecommerce features.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row d-none">
            <div class="col-md-6">
                {{ Field::select(__('Shop Page'), '_shop_page', [
                    'value' => get_config('_shop_page'),
                    'options' => $pages ?? [],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('This is the base page for your shop - displaying your products.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::select(__('Cart Page'), '_cart_page', [
                    'value' => get_config('_cart_page'),
                    'options' => $pages ?? [],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('Page that displays the shopping cart contents.') }}</small>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                {{ Field::select(__('Checkout Page'), '_checkout_page', [
                    'value' => get_config('_checkout_page'),
                    'options' => $pages ?? [],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('Page that handles the checkout process.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::select(__('Thank You Page'), '_thanks_page', [
                    'value' => get_config('_thanks_page'),
                    'options' => $pages ?? [],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('Page displayed after successful checkout.') }}</small>
            </div>
        </div>

        <div class="row mt-3 d-none">
            <div class="col-md-6">
                {{ Field::select(__('My Account Page'), '_account_page', [
                    'value' => get_config('_account_page'),
                    'options' => $pages ?? [],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('Page that displays customer account information.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::select(__('Terms and Conditions Page'), '_terms_page', [
                    'value' => get_config('_terms_page'),
                    'options' => $pages ?? [],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('Your terms and conditions page that will be linked in checkout.') }}</small>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4 d-none">
    <div class="card-header">
        <h5 class="card-title">{{ __('Product Settings') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure product display and behavior settings.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Enable Reviews'), '_enable_reviews', [
                        'value' => get_config('_enable_reviews', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Allow customers to leave product reviews.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Enable Product Gallery'), '_enable_gallery', [
                        'value' => get_config('_enable_gallery', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Enable the product image gallery on product pages.') }}</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                {{ Field::select(__('Catalog Mode'), '_catalog_mode', [
                    'value' => get_config('_catalog_mode', 'standard'),
                    'options' => [
                        'standard' => __('Standard (Show prices and allow purchases)'),
                        'catalog' => __('Catalog Only (Show prices but disable purchases)'),
                        'hidden' => __('Hidden Prices (Hide prices and disable purchases)'),
                    ],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('Control how products are displayed in your shop.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::select(__('Products Per Page'), '_products_per_page', [
                    'value' => get_config('_products_per_page', '12'),
                    'options' => [
                        '9' => '9',
                        '12' => '12',
                        '18' => '18',
                        '24' => '24',
                        '36' => '36',
                    ],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('Number of products to display per page.') }}</small>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4 d-none">
    <div class="card-header">
        <h5 class="card-title">{{ __('Inventory Settings') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure how product inventory is managed.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Manage Stock'), '_manage_stock', [
                        'value' => get_config('_manage_stock', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Enable stock management for products.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Show Out of Stock Products'), '_show_out_of_stock', [
                        'value' => get_config('_show_out_of_stock', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Display products that are out of stock in the catalog.') }}</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                {{ Field::select(__('Low Stock Threshold'), '_low_stock_threshold', [
                    'value' => get_config('_low_stock_threshold', '3'),
                    'options' => [
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '5' => '5',
                        '10' => '10',
                    ],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('Get notified when product stock reaches this amount.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::select(__('Out of Stock Behavior'), '_out_of_stock_behavior', [
                    'value' => get_config('_out_of_stock_behavior', 'hide_add_to_cart'),
                    'options' => [
                        'hide_add_to_cart' => __('Hide add to cart button'),
                        'show_notify' => __('Show "Notify me" button'),
                        'allow_backorders' => __('Allow backorders'),
                    ],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('Control what happens when a product is out of stock.') }}</small>
            </div>
        </div>
    </div>
</div>

