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


(function($) {
    "use strict";

    // Define our Checkout class that manages the checkout form submission.
    var Checkout = function(formSelector, options) {
        this.$form = $(formSelector);
        this.options = options || {};
        this.submitInProgress = false;
        this.$ajax = null;
        this.ajaxAbandonedTimeout = null;
        this.init();
    };

    Checkout.prototype.init = function() {
        var self = this;
        // Prevent default auto submission on form submit.
        this.$form.on('submit', function(e) {
            e.preventDefault();
            return false;
        });

        // Bind click event only on the checkout button.
        this.$form.find('.btn-checkout').on('click', function(e) {
            e.preventDefault();
            self.returnCheckout();
        });

        // OPTIONAL: If you want to use abandonedCheckout (to save user data in case of idle time)
        // You may set a flag so that it does not trigger on initial page load.
        // For instance, only start abandonedCheckout after the user has interacted with the form.
        // Here we are not auto-calling it on page load.
    };

    // This function submits the checkout form via AJAX when the user clicks the Place Order button.
    Checkout.prototype.returnCheckout = function() {
        var self = this;
        var $form = this.$form;
        
        // Validate the form; if there are errors, do not proceed.
        $form.validator("validate");
        if ($(".help-block.with-errors > ul").length > 0) {
            // Form has errors; do not submit.
            this.resetButton();
            return;
        }

        var actionUrl = $form.attr("action");
        var method = "POST";

        this.submitInProgress = true;
        $.ajax({
            url: actionUrl,
            type: method,
            global: true,
            data: $form.serialize()
        })
        .done(function(response) {
            if (response.status == "success" && response.data.redirect) {
                self.showToast('success', response.message || 'Order placed successfully!');
                // Redirect after a short delay
                setTimeout(function() {
                    window.location.href = response.data.redirect;
                }, 1000);
            } else {
                var errorHtml = "";
                if (response.errors && response.errors.length > 0) {
                    for (var i = 0; i < response.errors.length; i++) {
                        errorHtml += "<li>" + response.errors[i] + "</li>";
                    }
                } else {
                    errorHtml += "<li>" + response.message + "</li>";
                }
                $(".sidebar__content .has-error .help-block > ul").html(errorHtml);
                self.resetButton();
            }
            self.submitInProgress = false;
            return false;
        })
        .fail(function(xhr) {
            var response = xhr.responseJSON;
            var errorHtml = "";
            if (response && response.errors && response.errors.length > 0) {
                for (var i = 0; i < response.errors.length; i++) {
                    errorHtml += "<li>" + response.errors[i] + "</li>";
                }
            } else if(response && response.message) {
                errorHtml += "<li>" + response.message + "</li>";
            } else {
                errorHtml += "<li>An unexpected error occurred.</li>";
            }
            $(".sidebar__content .has-error .help-block > ul").html(errorHtml);
            self.resetButton();
            self.submitInProgress = false;
            return false;
        });
    };

    // Resets the checkout button text and state.
    Checkout.prototype.resetButton = function() {
        var $btn = this.$form.find('.btn-checkout');
        $btn.prop("disabled", false).text(this.options.buttonText || "Place Order");
    };

    // A helper to show toast notifications using Bootstrap Toasts.
    Checkout.prototype.showToast = function(type, message) {
        var toastClass = (type === 'error') ? 'bg-danger' : 'bg-success';
        var $toast = $(
            '<div class="toast ' + toastClass + ' text-white" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">' +
                '<div class="toast-body">' + message + '</div>' +
            '</div>'
        );

        if ($('#toast-container').length === 0) {
            $('body').append('<div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>');
        }
        $('#toast-container').append($toast);
        $toast.toast('show').on('hidden.bs.toast', function() {
            $(this).remove();
        });
    };

    // OPTIONAL: If you want to implement an "abandonedCheckout" feature,
    // you could call this function after some user interaction (not on page load).
    Checkout.prototype.abandonedCheckout = function() {
        var $form = this.$form;
        var currentUrl = window.location.href;

        if (this.$ajax) {
            this.$ajax.abort();
        }
        if (this.ajaxAbandonedTimeout) {
            clearTimeout(this.ajaxAbandonedTimeout);
        }
        var self = this;
        // Only trigger after a user has interacted (you can adjust the timeout)
        this.ajaxAbandonedTimeout = setTimeout(function() {
            self.$ajax = $.ajax({
                url: currentUrl,
                type: "POST",
                global: false,
                data: $form.serialize() + "&_method=patch",
                success: function(response) {
                    // No UI feedback required here.
                }
            });
        }, 3000);
    };

    // Initialize checkout functionality when document is ready.
    $(document).ready(function() {
        new Checkout("#checkout-form", {
            buttonText: "{{ trans('ecomm::content.place_order') }}"
        });
    });
})(jQuery);
