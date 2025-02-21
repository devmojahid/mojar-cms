window.Juzaweb = window.Juzaweb || {};

(function($) {
    'use strict';

    // Prevent multiple initializations
    if (window.checkoutInitialized) {
        return;
    }
    window.checkoutInitialized = true;

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

    // Add ShippingCalculator with proper scope
    Juzaweb.ShippingCalculator = function(checkout) {
        this.checkout = checkout;
        this.$calculateFee = null;
    };

    Juzaweb.ShippingCalculator.prototype = {
        calculateFeeAndSave: function(designThemeId) {
            if (this.$calculateFee) {
                this.$calculateFee.abort();
            }

            // Forward to checkout's calculation method if it exists
            if (this.checkout && typeof this.checkout.caculateShippingFee === 'function') {
                this.checkout.caculateShippingFee(designThemeId);

                // Call abandoned checkout if it exists
                if (typeof this.checkout.abandonedCheckout === 'function') {
                    this.checkout.abandonedCheckout();
                }
            } else {
                console.warn('Checkout object or caculateShippingFee method not available');
            }
        }
    };

    // Checkout Handler with recursion prevention
    Juzaweb.StoreCheckout = function(context, options) {
        // Prevent recursive initialization
        if (this._initializing) {
            return;
        }
        this._initializing = true;

        this.context = context;
        this.options = options || {};

        // Initialize all required properties first
        this.existCode = false;
        this.inValidCode = false;
        this.applyWithPromotion = false;
        this.freeShipping = false;
        this.discount = 0;
        this.totalOrderItemPrice = 0;
        this.totalPrice = 0;
        this.discountShipping = false;
        this.code = '';
        this.reduction_code = '';
        this.BillingProvinceId = 0;
        this.ShippingProvinceId = 0;
        this.BillingDistrictId = 0;
        this.ShippingDistrictId = 0;
        this.requiresShipping = true;
        this.shippingFee = 0;
        this.shippingMethod = '';
        this.invalidEmail = false;
        this.calculatingShippingFee = false;

        // Initialize token safely
        try {
            this.token = '';
            if (options && options.token) {
                this.token = options.token;
            } else if (window.Juzaweb && window.Juzaweb.Checkout && window.Juzaweb.Checkout.token) {
                this.token = window.Juzaweb.Checkout.token;
            }
        } catch (e) {
            console.error('Error initializing token:', e);
            this.token = '';
        }

        this.$form = $(context);
        this.submitInProgress = false;
        this.shippingMethodsLoading = false;
        this.loadedShippingMethods = false;
        this.otherAddress = false;
        this.show_district = window.show_district || false;
        this.show_country = window.show_country || false;
        this.settingLanguage = window.settingLanguage || 'en';
        this.shippingMethods = [];
        this.discountLabel = 'Free';
        this.$calculateFee = null;

        // Create shipping calculator instance
        this.shippingCalculator = new Juzaweb.ShippingCalculator(this);

        // Initialize with a slight delay to prevent call stack issues
        var self = this;
        setTimeout(function() {
            self.init();
            self._initializing = false;
        }, 0);
    };

    Juzaweb.StoreCheckout.prototype = {
        init: function() {
            // Don't initialize if no token
            if (!this.token) {
                return;
            }

            this.setupEventListeners();

            // Safe Twine binding
            if (typeof Twine !== 'undefined') {
                try {
                    var contextElement = this.$form.get(0);
                    if (contextElement) {
                        Twine.reset(contextElement);
                        Twine.bind(contextElement).refresh();
                    }
                } catch (e) {
                    console.error('Twine initial binding error:', e);
                }
            }

            // Only calculate shipping fee if we have a token
            var self = this;
            if (this.token) {
                setTimeout(function() {
                    self.caculateShippingFee();
                }, 500);
            }
        },

        setupEventListeners: function() {
            var self = this;

            // Handle shipping address checkbox - use delegation to prevent multiple bindings
            $(document).off('change', '#other_address').on('change', '#other_address', function() {
                self.otherAddress = $(this).is(':checked');
                self.changeOtherAddress(this);
            });

            // Handle province changes - use delegation
            $(document).off('change', 'select[name="BillingProvinceId"]')
                .on('change', 'select[name="BillingProvinceId"]', function() {
                    if (typeof self.billingProviceChange === 'function') {
                        self.billingProviceChange();
                    } else {
                        self.caculateShippingFee();
                    }
                });

            $(document).off('change', 'select[name="ShippingProvinceId"]')
                .on('change', 'select[name="ShippingProvinceId"]', function() {
                    if (typeof self.shippingProviceChange === 'function') {
                        self.shippingProviceChange();
                    } else {
                        self.caculateShippingFee();
                    }
                });

            // Handle district changes if enabled
            if (this.show_district) {
                $(document).off('change', 'select[name="BillingDistrictId"]')
                    .on('change', 'select[name="BillingDistrictId"]', function() {
                        self.caculateShippingFee();
                    });

                $(document).off('change', 'select[name="ShippingDistrictId"]')
                    .on('change', 'select[name="ShippingDistrictId"]', function() {
                        self.caculateShippingFee();
                    });
            }
        },

        caculateShippingFee: function(designThemeId) {
            // Early return if no token
            if (!this.token) {
                return false;
            }

            // Prevent multiple simultaneous requests
            if (this.calculatingShippingFee) {
                return false;
            }

            // Abort previous request if exists
            if (this.$calculateFee != null) {
                this.$calculateFee.abort();
            }

            var self = this;

            // Set calculating flag
            this.calculatingShippingFee = true;

            // Clear any existing timeout
            if (this.calculateFeeTimeout) {
                clearTimeout(this.calculateFeeTimeout);
            }

            // Debounce the calculation
            this.calculateFeeTimeout = setTimeout(function() {
                var provinceId = 0;
                var districtId = 0;

                if (self.settingLanguage === "vi") {
                    provinceId = self.otherAddress ?
                        (self.ShippingProvinceId || 0) :
                        (self.BillingProvinceId || 0);

                    districtId = self.otherAddress ?
                        (self.ShippingDistrictId || 0) :
                        (self.BillingDistrictId || 0);
                }

                var shippingMethod = $('[name="ShippingMethod"]:checked').val() || '';
                var email = $('#_email').val() || '';

                var url = '/checkout/getshipping/' + self.token;
                if (designThemeId) {
                    url += '?designThemeId=' + designThemeId;
                }

                var data = {
                    provinceId: provinceId,
                    districtId: districtId,
                    code: self.code || '',
                    shippingMethod: shippingMethod,
                    email: email
                };

                if (self.reduction_code) {
                    data.code = null;
                }

                self.shippingMethodsLoading = true;

                try {
                    if (typeof Twine !== 'undefined') {
                        Twine.refreshImmediately();
                    }
                } catch (e) {
                    console.error('Twine refresh error:', e);
                }

                self.$calculateFee = $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        self.handleShippingResponse(response);
                    },
                    error: function(xhr, status, error) {
                        self.shippingMethodsLoading = false;
                        self.calculatingShippingFee = false;
                        console.error('Shipping calculation error:', error);

                        try {
                            if (typeof Twine !== 'undefined') {
                                Twine.refreshImmediately();
                            }
                        } catch (e) {
                            console.error('Twine refresh error:', e);
                        }
                    },
                    complete: function() {
                        self.calculatingShippingFee = false;
                    }
                });
            }, 250); // Debounce delay
        },

        // Implement the calculateFeeAndSave method directly
        calculateFeeAndSave: function(designThemeId) {
            this.caculateShippingFee(designThemeId);
            if (typeof this.abandonedCheckout === 'function') {
                this.abandonedCheckout();
            }
        },

        abandonedCheckout: function() {
            // Implement abandoned checkout logic if needed
            console.log('Abandoned checkout handling');
        },

        handleShippingResponse: function(response) {
            // Set flags before processing to prevent undefined errors
            this.loadedShippingMethods = true;
            this.shippingMethodsLoading = false;
            this.calculatingShippingFee = false; // Make sure to reset the flag

            if (response.error) {
                this.shippingMethods = [];

                // Safe Twine refresh
                try {
                    if (typeof Twine !== 'undefined') {
                        Twine.refreshImmediately();
                    }
                } catch (e) {
                    console.error('Twine refresh error on error response:', e);
                }
            } else {
                // Process existCode logic
                this.existCode = response.exist_code || false;

                // Process code validation
                if (!this.code || this.existCode || this.reduction_code) {
                    this.inValidCode = false;
                    this.applyWithPromotion = response.apply_with_promotion || false;
                } else {
                    this.inValidCode = !this.existCode;
                    this.applyWithPromotion = true;
                }

                // Update other properties from response
                this.freeShipping = response.free_shipping || false;
                this.discount = response.discount || 0;
                this.totalOrderItemPrice = response.total_line_item_price || 0;
                this.totalPrice = response.total_price || 0;
                this.discountShipping = response.discount_shipping || false;

                // Update shipping methods if shipping is required
                if (this.requiresShipping) {
                    this.shippingMethods = response.shipping_methods || [];
                }

                // Clear and update shipping methods UI
                var $contentBox = $('.shipping-method .content-box');
                $contentBox.empty();

                if (this.shippingMethods && this.shippingMethods.length) {
                    for (var i in this.shippingMethods) {
                        var method = this.shippingMethods[i];
                        if (typeof Juzaweb.Template !== 'undefined' && Juzaweb.Template.SHIPPING_METHOD) {
                            var template = Juzaweb.Template.SHIPPING_METHOD
                                .replace(/{{shipping_method_value}}/g, method.value || '')
                                .replace(/{{shipping_method_name}}/g, method.name || '')
                                .replace(/{{shipping_method_fee}}/g, method.fee || 0)
                                .replace(/{{shipping_method_id}}/g, method.id || '')
                                .replace(/{{shipping_method_fee_text}}/g, method.fee != 0 ? method.fee : (this.discountLabel || 'Free'));

                            $contentBox.append(template);
                        }
                    }
                }

                // Safe Twine rebinding for shipping methods content
                try {
                    if (typeof Twine !== 'undefined') {
                        var contentBoxElement = $contentBox.get(0);
                        if (contentBoxElement) {
                            Twine.unbind(contentBoxElement);
                            Twine.bind(contentBoxElement);
                        }
                    }
                } catch (e) {
                    console.error('Twine binding error on shipping methods:', e);
                }

                // Select default shipping method if provided
                if (response.shipping_method) {
                    $("[name=ShippingMethod][value='" + response.shipping_method + "']").click();
                }

                // Call apply method if it exists
                if (typeof this.applyShippingMethod === 'function') {
                    this.applyShippingMethod();
                }

                // Safe final Twine refresh
                try {
                    if (typeof Twine !== 'undefined') {
                        Twine.refreshImmediately();
                    }
                } catch (e) {
                    console.error('Twine final refresh error:', e);
                }
            }
        },

        changeOtherAddress: function(element) {
            this.otherAddress = $(element).is(':checked');
            if (this.show_district) {
                if (typeof this.showShippingDistrict === 'function') {
                    this.showShippingDistrict();
                }
            } else {
                this.caculateShippingFee();
            }
        },

        applyShippingMethod: function() {
            // Implementation depends on your specific requirements
            console.log('Shipping method applied');
        },

        billingProviceChange: function() {
            this.caculateShippingFee();
        },

        shippingProviceChange: function() {
            this.caculateShippingFee();
        },

        showShippingDistrict: function() {
            // Implementation depends on specific requirements
            this.caculateShippingFee();
        },

        // Add shippingDistrictChange method
        shippingDistrictChange: function(designThemeId) {
            if (this.otherAddress) {
                this.caculateShippingFee(designThemeId);
                if (this.show_ward && typeof this.showShippingWard === 'function') {
                    this.showShippingWard(designThemeId);
                }
                if (typeof this.abandonedCheckout === 'function') {
                    this.abandonedCheckout();
                }
            } else if ($("select[name='ShippingWardId']").length > 0 &&
                       $("select[name='ShippingWardId'] >option").length <= 0 &&
                       this.show_ward &&
                       typeof this.showShippingWard === 'function') {
                this.showShippingWard(designThemeId);
            }
        },

        showShippingWard: function() {
            // Implement ward display logic if needed
            console.log('Show shipping ward');
        }
    };

    // Initialize templates if not already defined
    Juzaweb.Template = Juzaweb.Template || {};
    Juzaweb.Template.SHIPPING_METHOD = Juzaweb.Template.SHIPPING_METHOD ||
        '<div class="content-box__row">' +
            '<div class="radio-wrapper">' +
                '<div class="radio__input">' +
                    '<input type="radio" class="input-radio" name="ShippingMethod" id="shipping_method_{{shipping_method_id}}" value="{{shipping_method_value}}">' +
                '</div>' +
                '<label for="shipping_method_{{shipping_method_id}}" class="radio__label">' +
                    '<span class="radio__label__primary">{{shipping_method_name}}</span>' +
                    '<span class="radio__label__accessory">' +
                        '<span class="radio__label__price">{{shipping_method_fee_text}}</span>' +
                    '</span>' +
                '</label>' +
            '</div>' +
        '</div>';

    // Safe initialization on document ready with single instance guarantee
    var checkoutInstance = null;
    $(document).ready(function() {
        // Prevent multiple initializations
        if (checkoutInstance) return;

        try {
            if ($('.formCheckout').length) {
                // Create a single instance
                checkoutInstance = new Juzaweb.StoreCheckout('.formCheckout');
                window.checkout = checkoutInstance;
            }
        } catch (e) {
            console.error('Error initializing checkout:', e);
        }
    });

})(jQuery);
