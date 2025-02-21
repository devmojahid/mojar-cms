window.Juzaweb = window.Juzaweb || {};

(function($) {
    'use strict';

    // Payment Status Handler
    Juzaweb.PaymentStatus = function(options) {
        this.options = options || {};
        this.currentInterval = null;
        this.pollingCount = 0;
        this.remaining = 300;
    };

    Juzaweb.PaymentStatus.prototype = {
        startPolling: function() {
            var self = this;
            this.currentInterval = setInterval(function() {
                self.checkStatus();
            }, 3000);
        },

        checkStatus: function() {
            this.pollingCount++;
            // Implement status checking logic here
        },

        stopPolling: function() {
            if (this.currentInterval) {
                clearInterval(this.currentInterval);
            }
        }
    };

    // Add ShippingCalculator
    Juzaweb.ShippingCalculator = function(checkout) {
        this.checkout = checkout;
        this.$calculateFee = null;
    };

    Juzaweb.ShippingCalculator.prototype = {
        calculateFeeAndSave: function() {
            if (this.$calculateFee) {
                this.$calculateFee.abort();
            }

            var self = this;
            var data = this.checkout.$form.serialize();

            this.$calculateFee = $.ajax({
                url: window.ecommerceConfig?.routes?.calculateShipping || '/checkout/calculate-shipping',
                type: 'POST',
                data: data,
                success: function(response) {
                    if (response.success) {
                        self.handleShippingResponse(response);
                    }
                },
                error: function() {
                    console.log('Shipping calculation failed');
                }
            });
        },

        handleShippingResponse: function(response) {
            if (typeof Twine !== 'undefined') {
                Twine.refreshImmediately();
            }

            if (response.shipping_method) {
                $("[name=ShippingMethod][value='" + response.shipping_method + "']").click();
            }
        }
    };

    // Checkout Handler
    Juzaweb.StoreCheckout = function(context, options) {
        this.context = context;
        this.options = options || {};
        this.$form = $(context);
        this.submitInProgress = false;
        this.shippingMethodsLoading = false;
        this.loadedShippingMethods = false;
        this.otherAddress = false;
        this.show_district = window.show_district || false;
        this.show_country = window.show_country || false;
        this.token = Juzaweb.Checkout.token;
        this.settingLanguage = window.settingLanguage || 'en';
        this.init();
    };

    Juzaweb.StoreCheckout.prototype = {
        init: function() {
            var self = this;
            this.setupEventListeners();

            // Initialize Twine bindings properly
            if (typeof Twine !== 'undefined') {
                Twine.reset(document.body);
                Twine.bind(document.body).refresh();
            }

            // Calculate shipping fee on init
            setTimeout(function() {
                self.caculateShippingFee();
            }, 0);
        },

        setupEventListeners: function() {
            var self = this;

            // Handle shipping address checkbox
            $('#other_address').on('change', function() {
                self.otherAddress = $(this).is(':checked');
                self.changeOtherAddress(this);
            });

            // Handle province changes
            $('select[name="BillingProvinceId"]').on('change', function() {
                self.billingProviceChange();
            });

            $('select[name="ShippingProvinceId"]').on('change', function() {
                self.shippingProviceChange();
            });

            // Handle district changes if enabled
            if (this.show_district) {
                $('select[name="BillingDistrictId"]').on('change', function() {
                    self.caculateShippingFee();
                });
            }
        },

        caculateShippingFee: function() {
            if (this.$calculateFee) {
                this.$calculateFee.abort();
            }

            var self = this;
            var provinceId = this.otherAddress ? this.ShippingProvinceId : this.BillingProvinceId;
            var districtId = this.otherAddress ? this.ShippingDistrictId : this.BillingDistrictId;

            var data = {
                provinceId: provinceId,
                districtId: districtId,
                code: this.code,
                shippingMethod: $('[name="ShippingMethod"]:checked').val(),
                email: $('#_email').val()
            };

            this.shippingMethodsLoading = true;
            if (typeof Twine !== 'undefined') {
                Twine.refreshImmediately();
            }

            this.$calculateFee = $.ajax({
                url: '/checkout/getshipping/' + this.token,
                type: 'POST',
                data: data,
                success: function(response) {
                    self.handleShippingResponse(response);
                },
                error: function() {
                    self.shippingMethodsLoading = false;
                }
            });
        },

        handleShippingResponse: function(response) {
            this.loadedShippingMethods = true;
            this.shippingMethodsLoading = false;

            if (response.error) {
                this.shippingMethods = [];
            } else {
                this.shippingMethods = response.shipping_methods;
                this.existCode = response.exist_code;
                this.freeShipping = response.free_shipping;
                this.discount = response.discount;

                // Update shipping methods UI
                $('.shipping-method .content-box').empty();
                for (var i in this.shippingMethods) {
                    var method = this.shippingMethods[i];
                    // Add shipping method to UI
                }

                if (typeof Twine !== 'undefined') {
                    Twine.refreshImmediately();
                }

                // Select default shipping method
                if (response.shipping_method) {
                    $("[name=ShippingMethod][value='" + response.shipping_method + "']").click();
                }
            }
        },

        changeOtherAddress: function(element) {
            this.otherAddress = $(element).is(':checked');
            if (this.show_district) {
                this.showShippingDistrict();
            } else {
                this.caculateShippingFee();
            }
        }
    };

    // Initialize on document ready
    $(document).ready(function() {
        if ($('.formCheckout').length) {
            window.checkout = new Juzaweb.StoreCheckout('.formCheckout');
        }
    });

})(jQuery);
