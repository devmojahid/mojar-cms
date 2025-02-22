window.Juzaweb = window.Juzaweb || {};

(function($) {
    'use strict';

    /*****************************************************
     * 1) Juzaweb.Utility (optional helpers)
     *****************************************************/
    Juzaweb.Utility = Juzaweb.Utility || {
        getParameter: function (t) {
            // Retrieve query string parameter by name
            t = t.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var e = new RegExp("[\\?&]" + t + "=([^&#]*)").exec(location.search);
            return (e === null) ? "" : decodeURIComponent(e[1].replace(/\+/g, " "));
        }
    };

    /*****************************************************
     * 2) Juzaweb.Template - shipping method HTML
     *****************************************************/
    Juzaweb.Template = Juzaweb.Template || {};

    // Shipping method template used by handleShippingResponse()
    // Matches your old checkout.min.js version + twig structure
    Juzaweb.Template.SHIPPING_METHOD = Juzaweb.Template.SHIPPING_METHOD ||
        '<div class="content-box__row">' +
            '<div class="radio-wrapper">' +
                '<div class="radio__input">' +
                    '<input class="input-radio" ' +
                           'type="radio" ' +
                           'value="{{shipping_method_value}}" ' +
                           'name="ShippingMethod" ' +
                           'id="shipping_method_{{shipping_method_id}}" ' +
                           'fee="{{shipping_method_fee}}" ' +
                           'bind="shippingMethod" ' +
                           'bind-event-change="changeShippingMethod()" ' +
                    '/>' +
                '</div>' +
                '<label class="radio__label" for="shipping_method_{{shipping_method_id}}">' +
                    '<span class="radio__label__primary">{{shipping_method_name}}</span>' +
                    '<span class="radio__label__accessory">' +
                        '<span class="content-box__emphasis">{{shipping_method_fee_text}}</span>' +
                    '</span>' +
                '</label>' +
            '</div>' +
        '</div>';

    /*****************************************************
     * 3) Juzaweb.PaymentStatus
     *    (From your new file to check payment polling)
     *****************************************************/
    Juzaweb.PaymentStatus = function(options) {
        this.options = options || {};
        this.currentInterval = null;
        this.pollingCount = 0;
        this.remaining = 300; // example default
    };

    Juzaweb.PaymentStatus.prototype = {
        startPolling: function() {
            var self = this;
            this.currentInterval = setInterval(function() {
                self.checkStatus();
            }, 3000);
        },

        checkStatus: function() {
            // Example logic or AJAX call to check payment status
            this.pollingCount++;
        },

        stopPolling: function() {
            if (this.currentInterval) {
                clearInterval(this.currentInterval);
            }
        }
    };

    /*****************************************************
     * 4) Juzaweb.ShippingCalculator
     *    (Used by StoreCheckout to handle shipping fee logic)
     *****************************************************/
    Juzaweb.ShippingCalculator = function(checkout) {
        this.checkout = checkout;
        this.$calculateFee = null;
    };

    Juzaweb.ShippingCalculator.prototype = {
        calculateFeeAndSave: function(designThemeId) {
            // Abort any existing request
            if (this.$calculateFee) {
                this.$calculateFee.abort();
            }

            // Forward to the main checkout's calc if it exists
            if (this.checkout && typeof this.checkout.caculateShippingFee === 'function') {
                this.checkout.caculateShippingFee(designThemeId);

                // If you want to also track an abandoned checkout
                if (typeof this.checkout.abandonedCheckout === 'function') {
                    this.checkout.abandonedCheckout();
                }
            } else {
                console.warn('Checkout object or caculateShippingFee method is not available.');
            }
        }
    };

    /*****************************************************
     * 5) Juzaweb.StoreCheckout (main logic)
     *****************************************************/
    Juzaweb.StoreCheckout = function(context, options) {
        // Prevent re-initializing in a loop
        if (this._initializing) {
            return;
        }
        this._initializing = true;

        // Basic references
        this.context = context;
        this.options = options || {};

        // Key properties from old + new code
        this.existCode             = false;
        this.inValidCode           = false;
        this.applyWithPromotion    = false;
        this.freeShipping          = false;
        this.discount              = 0;
        this.totalOrderItemPrice   = 0;
        this.totalPrice            = 0;
        this.discountShipping      = false;
        this.code                  = '';
        this.reduction_code        = '';
        this.BillingProvinceId     = 0;
        this.ShippingProvinceId    = 0;
        this.BillingDistrictId     = 0;
        this.ShippingDistrictId    = 0;
        this.requiresShipping      = true;
        this.shippingFee           = 0;
        this.shippingMethod        = '';
        this.invalidEmail          = false;
        this.calculatingShippingFee= false;
        this.shippingMethods       = [];
        this.shippingMethodsLoading= false;
        this.loadedShippingMethods = false;
        this.otherAddress          = false;
        this.discountLabel         = this.options.discountLabel || 'Free';
        this.settingLanguage       = this.options.settingLanguage || 'en';
        this.show_district         = window.show_district || false;
        this.show_country          = window.show_country || false;

        // form / submission
        this.$form                = $(context);
        this.submitInProgress     = false;

        // For abandoned checkout requests
        this.$ajax                = null;
        this.ajaxAbandonedTimeout = null;

        // shipping calculator sub-class
        this.shippingCalculator = new Juzaweb.ShippingCalculator(this);

        // Attempt to set your checkout token
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

        var self = this;
        // Slight delay to allow Twine or other scripts to load
        setTimeout(function() {
            self.init();
            self._initializing = false;
        }, 0);
    };

    // Extend the prototype with methods from old & new code
    Juzaweb.StoreCheckout.prototype = {

        /*************************************************
         * init: set up event listeners + do first calc
         *************************************************/
        init: function() {
            if (!this.token) {
                // If no token, do nothing
                return;
            }

            this.setupEventListeners();

            // Twine initialization or re-binding
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

            // Attempt first shipping fee calculation
            var self = this;
            if (this.token) {
                setTimeout(function() {
                    self.caculateShippingFee();
                }, 500);
            }
        },

        /*************************************************
         * setupEventListeners: watch province changes, etc.
         *************************************************/
        setupEventListeners: function() {
            var self = this;

            // Other address checkbox
            $(document)
                .off('change', '#other_address')
                .on('change', '#other_address', function() {
                    self.otherAddress = $(this).is(':checked');
                    self.changeOtherAddress(this);
                });

            // Billing province
            $(document)
                .off('change', 'select[name="BillingProvinceId"]')
                .on('change', 'select[name="BillingProvinceId"]', function() {
                    if (typeof self.billingProviceChange === 'function') {
                        self.billingProviceChange();
                    } else {
                        self.caculateShippingFee();
                    }
                });

            // Shipping province
            $(document)
                .off('change', 'select[name="ShippingProvinceId"]')
                .on('change', 'select[name="ShippingProvinceId"]', function() {
                    if (typeof self.shippingProviceChange === 'function') {
                        self.shippingProviceChange();
                    } else {
                        self.caculateShippingFee();
                    }
                });

            // If your theme uses district dropdown
            if (this.show_district) {
                $(document)
                    .off('change', 'select[name="BillingDistrictId"]')
                    .on('change', 'select[name="BillingDistrictId"]', function() {
                        self.caculateShippingFee();
                    });

                $(document)
                    .off('change', 'select[name="ShippingDistrictId"]')
                    .on('change', 'select[name="ShippingDistrictId"]', function() {
                        self.caculateShippingFee();
                    });
            }
        },

        /*************************************************
         * handleFocus/Blur/Click for Twine field highlighting
         *************************************************/
        handleClick: function(element) {
            // Focus the input inside the same .field__input-wrapper
            $(element).closest('.field__input-wrapper').find('.field__input').focus();
        },

        handleFocus: function(element) {
            $(element).closest('.field__input-wrapper').addClass('js-is-focused');
        },

        handleFieldBlur: function(element) {
            $(element).closest('.field__input-wrapper').removeClass('js-is-focused');
        },

        /*************************************************
         * Email changed => check validity, do shipping calc
         *************************************************/
        changeEmail: function() {
            var val = $('#_email').val();
            // Basic email regex from old code
            var isValid = /^([a-zA-Z0-9_.+\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(val);
            this.invalidEmail = !isValid;

            if (isValid) {
                // If you had a code, recalc shipping
                if (this.code) {
                    this.caculateShippingFee();
                }
                // Possibly queue an abandoned checkout update
                this.abandonedCheckout();
            }
        },

        /*************************************************
         * saveAbandoned => trigger partial save
         *************************************************/
        saveAbandoned: function() {
            this.abandonedCheckout();
        },

        /*************************************************
         * abandonedCheckout => old partial save
         *************************************************/
        abandonedCheckout: function() {
            var form = $('form.formCheckout'),
                url  = window.location.href;

            // Abort prior request if any
            if (this.$ajax) {
                this.$ajax.abort();
            }
            if (this.ajaxAbandonedTimeout) {
                clearTimeout(this.ajaxAbandonedTimeout);
            }

            var self = this;
            // Delay to avoid spamming
            this.ajaxAbandonedTimeout = setTimeout(function() {
                self.$ajax = $.ajax({
                    url: url,
                    type: 'POST',
                    global: false,
                    data: form.serialize() + '&_method=patch',
                    success: function(resp) {
                        // console.log('Abandoned checkout updated');
                    }
                });
            }, 3000);
        },

        /*************************************************
         * Billing province changed => recalc or do logic
         *************************************************/
        billingProviceChange: function() {
            this.caculateShippingFee();
        },

        /*************************************************
         * Shipping province changed => recalc or do logic
         *************************************************/
        shippingProviceChange: function() {
            this.caculateShippingFee();
        },

        /*************************************************
         * Actually call the shipping fee endpoint
         *************************************************/
        caculateShippingFee: function(designThemeId) {
            // If no token or already in progress, skip
            if (!this.token) {
                return false;
            }
            if (this.calculatingShippingFee) {
                return false;
            }

            // Abort any previous calculation
            if (this.$calculateFee) {
                this.$calculateFee.abort();
            }

            var self = this;
            this.calculatingShippingFee = true;

            // Debounce approach
            if (this.calculateFeeTimeout) {
                clearTimeout(this.calculateFeeTimeout);
            }

            this.calculateFeeTimeout = setTimeout(function() {
                var provinceId = 0,
                    districtId = 0;

                if (self.settingLanguage === 'vi') {
                    provinceId = self.otherAddress ? (self.ShippingProvinceId || 0) : (self.BillingProvinceId || 0);
                    districtId = self.otherAddress ? (self.ShippingDistrictId || 0) : (self.BillingDistrictId || 0);
                }

                var shippingMethod = $('[name="ShippingMethod"]:checked').val() || '';
                var email          = $('#_email').val() || '';
                var url            = '/checkout/getshipping/' + self.token;

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

                // Twine immediate refresh if available
                try { if (typeof Twine !== 'undefined') Twine.refreshImmediately(); } catch(e){}

                self.$calculateFee = $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        self.handleShippingResponse(response);
                    },
                    error: function(xhr, status, error) {
                        self.shippingMethodsLoading  = false;
                        self.calculatingShippingFee = false;
                        console.error('Shipping calculation error:', error);
                        try { if (typeof Twine !== 'undefined') Twine.refreshImmediately(); } catch(e){}
                    },
                    complete: function() {
                        self.calculatingShippingFee = false;
                    }
                });
            }, 250); // short debounce
        },

        /*************************************************
         * handleShippingResponse => fill shipping methods
         *************************************************/
        handleShippingResponse: function(response) {
            this.loadedShippingMethods  = true;
            this.shippingMethodsLoading = false;
            this.calculatingShippingFee = false;

            if (response.error) {
                // If server side error => no shipping
                this.shippingMethods = [];
                try { if (typeof Twine !== 'undefined') Twine.refreshImmediately(); } catch(e){}
            } else {
                // Set code exist logic
                this.existCode = response.exist_code || false;

                if (!this.code || this.existCode || this.reduction_code) {
                    this.inValidCode = false;
                    this.applyWithPromotion = response.apply_with_promotion || false;
                } else {
                    this.inValidCode = !this.existCode;
                    this.applyWithPromotion = true;
                }

                // Other data from server
                this.freeShipping = response.free_shipping || false;
                this.discount     = response.discount || 0;
                this.totalOrderItemPrice = response.total_line_item_price || 0;
                this.totalPrice   = response.total_price || 0;
                this.discountShipping = response.discount_shipping || false;

                // If shipping is required, update shippingMethods
                if (this.requiresShipping) {
                    this.shippingMethods = response.shipping_methods || [];
                }

                // Render shipping method list
                var $contentBox = $('.shipping-method .content-box');
                $contentBox.empty();

                if (this.shippingMethods && this.shippingMethods.length) {
                    for (var i in this.shippingMethods) {
                        var method = this.shippingMethods[i];
                        if (Juzaweb.Template && Juzaweb.Template.SHIPPING_METHOD) {
                            var html = Juzaweb.Template.SHIPPING_METHOD
                                .replace(/{{shipping_method_value}}/g, method.value || '')
                                .replace(/{{shipping_method_name}}/g, method.name || '')
                                .replace(/{{shipping_method_fee}}/g, method.fee || 0)
                                .replace(/{{shipping_method_id}}/g, method.id || '')
                                .replace(/{{shipping_method_fee_text}}/g, (method.fee !== 0)
                                    ? method.fee
                                    : (this.discountLabel || 'Free'));

                            $contentBox.append(html);
                        }
                    }
                }

                // Re-bind Twine on the shipping method container
                try {
                    if (typeof Twine !== 'undefined') {
                        var contentBoxElement = $contentBox.get(0);
                        Twine.unbind(contentBoxElement);
                        Twine.bind(contentBoxElement);
                        Twine.refreshImmediately();
                    }
                } catch(e) { console.error('Twine bind error:', e); }

                // Pre-select returned shipping method if set
                if (response.shipping_method) {
                    $("[name=ShippingMethod][value='" + response.shipping_method + "']").click();
                }

                // Then apply shipping method fees
                if (typeof this.applyShippingMethod === 'function') {
                    this.applyShippingMethod();
                }

                try { if (typeof Twine !== 'undefined') Twine.refreshImmediately(); } catch(e){}
            }
        },

        /*************************************************
         * applyShippingMethod => final fee & discount logic
         *************************************************/
        applyShippingMethod: function() {
            this.shippingMethod = $('[name="ShippingMethod"]:checked').val() || '';
            var fee = parseFloat($('[name="ShippingMethod"]:checked').attr('fee') || 0);

            if (this.discountShipping) {
                // If discount shipping means "free if fee <= 0"
                if (fee <= 0) {
                    this.freeShipping = true;
                    this.discount     = fee; // or 0
                } else {
                    this.freeShipping = false;
                    this.discount     = 0;
                }
            } else {
                // Non-discount shipping => free if fee=0
                this.freeShipping = (fee <= 0);
            }
            this.shippingFee = fee;

            // Refresh Twine data
            try {
                if (typeof Twine !== 'undefined') {
                    Twine.refreshImmediately();
                }
            } catch(e){}
        },

        /*************************************************
         * changeShippingMethod => on radio change
         *************************************************/
        changeShippingMethod: function() {
            // Just calls applyShippingMethod
            this.applyShippingMethod();
        },

        /*************************************************
         * removeCode => "X" discount code in twig
         *************************************************/
        removeCode: function(designThemeId) {
            this.code = '';
            this.caculateShippingFee(designThemeId);
        },

        /*************************************************
         * Toggle other address => if you want dynamic required
         *************************************************/
        changeOtherAddress: function(element) {
            this.otherAddress = $(element).is(':checked');
            // If you want old dynamic required logic, do:
            // this.bindRequiredOtherAddress();
            // or simply recalc shipping fee
            this.caculateShippingFee();
        },

        /*************************************************
         * (Optional) bindRequiredOtherAddress
         *************************************************/
        bindRequiredOtherAddress: function() {
            // Example from old code
            if (this.otherAddress) {
                $("#_shipping_address_last_name").prop("required", true);
                $("#_shipping_address_phone").prop("required", true);
                $("#_shipping_address_address1").prop("required", true);
                $("#shippingProvince").prop("required", true);
                $("#shippingDistrict").prop("required", true);
                $("#shippingWard").prop("required", true);
            } else {
                $("#_shipping_address_last_name").removeAttr("required");
                $("#_shipping_address_phone").removeAttr("required");
                $("#_shipping_address_address1").removeAttr("required");
                $("#shippingProvince").removeAttr("required");
                $("#shippingDistrict").removeAttr("required");
                $("#shippingWard").removeAttr("required");
            }
        },

        /*************************************************
         * paymentCheckout => your twig calls it for small device
         *************************************************/
        paymentCheckout: function(apiKeys) {
            // In old code, it called returnCheckout(); or so.
            // We'll unify to call your new submitCheckout() method
            console.log('Payment checkout triggered with key:', apiKeys);
            $(".btn-checkout").prop("disabled", true).button('loading');
            this.submitCheckout();
        },

        /*************************************************
         *  DO NOT MODIFY: your new submitCheckout() method
         *************************************************/
        submitCheckout: function() {
            // EXACTLY as your new code does it
            if (this.submitInProgress) {
                return false;
            }

            var form = $('.formCheckout');
            var self = this;

            this.submitInProgress = true;
            $('.btn-checkout').prop('disabled', true);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if (response?.status) {
                        window.location.href = response?.data?.redirect || '/checkout/success';
                    } else {
                        self.handleError(response.message || 'Checkout failed');
                    }
                },
                error: function(xhr) {
                    var errorMsg = 'An error occurred during checkout';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    self.handleError(errorMsg);
                },
                complete: function() {
                    self.submitInProgress = false;
                    $('.btn-checkout').prop('disabled', false);
                }
            });

            return false;
        },

        /*************************************************
         * handleError => show in .sidebar__content .has-error
         *************************************************/
        handleError: function(message) {
            var errorHtml = '<li>' + message + '</li>';
            $('.sidebar__content .has-error .help-block > ul').html(errorHtml);
        }
    };

    /*************************************************************
     * 6) Static function for toggling order summary in twig
     *    (bind-event-click="Juzaweb.StoreCheckout.toggleOrderSummary(this)")
     *************************************************************/
    Juzaweb.StoreCheckout.toggleOrderSummary = function(el) {
        // This matches your old min.js approach of toggling .order-summary--product-list
        var $toggleBtn  = $(el),
            $orderList  = $(".order-summary--product-list");

        // Simple slide or height animation
        $orderList.wrapInner("<div />");

        var startHeight = $orderList.height(),
            innerHeight = $orderList.find("> div").height(),
            endHeight   = (startHeight === 0) ? innerHeight : 0;

        $orderList.css("height", startHeight);
        $orderList.find("> div").contents().unwrap();

        setTimeout(function() {
            $toggleBtn.toggleClass("order-summary-toggle--hide");
            $orderList.toggleClass("order-summary--is-collapsed");
            $orderList.addClass("order-summary--transition");
            $orderList.css("height", endHeight);
        }, 0);

        $orderList.one("webkitTransitionEnd oTransitionEnd otransitionend transitionend msTransitionEnd", function(ev) {
            if ($orderList.is(ev.target)) {
                $orderList.removeClass("order-summary--transition");
                $orderList.removeAttr("style");
            }
        });
    };

    /*************************************************************
     * 7) Create a single Checkout instance on page load
     *************************************************************/
    var checkoutInstance = null;

    $(document).ready(function() {
        // Avoid double init
        if (checkoutInstance) return;

        try {
            if ($('.formCheckout').length) {
                // Pass any relevant “options” from twig if needed
                checkoutInstance = new Juzaweb.StoreCheckout('.formCheckout', {
                    token: (window.Juzaweb.Checkout && window.Juzaweb.Checkout.token) || '',
                    settingLanguage: 'vi', // or 'en' (from your twig)
                    discountLabel:  'Free'
                    // ... other custom init data
                });
                // Expose globally if needed
                window.checkout = checkoutInstance;
            }
        } catch (e) {
            console.error('Error initializing checkout:', e);
        }
    });

})(jQuery);
