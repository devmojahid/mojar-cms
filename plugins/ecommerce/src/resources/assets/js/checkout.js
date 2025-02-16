window.Juzaweb = window.Juzaweb || {};

(function($) {
    'use strict';

    if (typeof $ === 'undefined') {
        console.error('jQuery is required');
        return;
    }

    Juzaweb.StoreCheckout = function(context, options) {
        if (!context) {
            console.error('Context is required');
            return;
        }

        this.context = context;
        this.options = options || {};
        this.submitInProgress = false;
        this.init();
    };

    Juzaweb.StoreCheckout.prototype = {
        init: function() {
            console.log('Initializing checkout...');
            this.setupEventListeners();
            this.initializeForm();
        },

        setupEventListeners: function() {
            var self = this;

            // Handle form submission
            $(this.context).on('click', '.btn-checkout', function(e) {
                e.preventDefault();
                self.submitCheckout();
            });

            // Remove any automatic form submission
            $(this.context).find('form').on('submit', function(e) {
                e.preventDefault();
                return false;
            });

            // Handle shipping address changes
            $(this.context).on('change', '[name^="shipping_address"]', function() {
                self.updateShipping();
            });
        },

        initializeForm: function() {
            var self = this;

            // Initialize select2 if present
            if($.fn.select2) {
                $('.filter-dropdown').select2({
                    width: '100%'
                });
            }

            // Calculate initial shipping
            this.calculateShipping();
        },

        submitCheckout: function() {
            // Prevent multiple submissions
            if (this.submitInProgress) {
                return;
            }

            var self = this;
            var $form = $(this.context).find('form');
            var $submitButton = $('.btn-checkout');

            this.submitInProgress = true;
            $submitButton.prop('disabled', true)
                        .val($submitButton.data('loading-text'));

            $.ajax({
                url: window.ecommerceConfig.routes.checkout,
                method: 'POST',
                data: $form.serialize(),
                success: function(response) {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                },
                error: function(xhr) {
                    self.submitInProgress = false;
                    $submitButton.prop('disabled', false)
                                .val(Juzaweb.trans('ecomm::content.order'));
                    console.error('Checkout error:', xhr);
                    alert(xhr.responseJSON?.message || 'An error occurred');
                }
            });
        },

        calculateShipping: function() {
            var self = this;
            var shippingMethods = this.options.shippingMethods || [];

            // Safely check length
            if (typeof shippingMethods.length === 'undefined') {
                console.warn('shippingMethods is not an array');
                return;
            }

            $.ajax({
                url: window.ecommerceConfig.routes.update,
                method: 'POST',
                data: {
                    _token: window.ecommerceConfig.csrf_token,
                    action: 'calculate_shipping',
                    shipping_address: this.getShippingAddress()
                },
                success: function(response) {
                    self.updateTotals(response.data);
                }
            });
        },

        getShippingAddress: function() {
            var address = {};
            $('[name^="shipping_address"]').each(function() {
                var key = $(this).attr('name').replace('shipping_address[', '').replace(']', '');
                address[key] = $(this).val();
            });
            return address;
        },

        updateTotals: function(data) {
            // Update totals display
            $('.shipping-fee').text(data.shipping_fee_formatted);
            $('.order-total').text(data.total_formatted);
        }
    };
})(window.jQuery);
