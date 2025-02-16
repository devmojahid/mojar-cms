window.Juzaweb = window.Juzaweb || {};

(function($) {
    'use strict';

    if (typeof $ === 'undefined') {
        console.error('jQuery is required');
        return;
    }

    console.log('Checkout JS Loaded');

    Juzaweb.StoreCheckout = function(context, options) {
        if (!context) {
            console.error('Context is required');
            return;
        }

        this.context = context;
        this.options = options || {};
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
            var self = this;
            var $form = $(this.context).find('form');
            var data = $form.serialize();

            $.ajax({
                url: window.ecommerceConfig.routes.checkout,
                method: 'POST',
                data: data,
                beforeSend: function() {
                    $('.btn-checkout').prop('disabled', true);
                },
                success: function(response) {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                },
                error: function(xhr) {
                    console.error('Checkout error:', xhr);
                    alert(xhr.responseJSON?.message || 'An error occurred');
                },
                complete: function() {
                    $('.btn-checkout').prop('disabled', false);
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
