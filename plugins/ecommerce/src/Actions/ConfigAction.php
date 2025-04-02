<?php

namespace Mojahid\Ecommerce\Actions;

use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;

class ConfigAction extends Action
{
    public function handle(): void
    {
        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerConfigs']
        );
    }

    public function registerConfigs(): void
    {
        HookAction::registerConfig(
            [
                // Store Address Settings
                '_store_address1' => [
                    'label' => 'Store Address Line 1',
                    'type' => 'text',
                ],
                '_store_address2' => [
                    'label' => 'Store Address Line 2',
                    'type' => 'text',
                ],
                '_city' => [
                    'label' => 'City',
                    'type' => 'text',
                ],
                '_country' => [
                    'label' => 'Country',
                    'type' => 'select',
                ],
                '_zipcode' => [
                    'label' => 'Zipcode',
                    'type' => 'text',
                ],
                
                '_terms_page' => [
                    'label' => 'Terms and Conditions Page',
                    'type' => 'select_page',
                ],
                '_shop_page' => [
                    'label' => 'Shop Page',
                    'type' => 'select_page',
                ],
                '_cart_page' => [
                    'label' => 'Cart Page',
                    'type' => 'select_page',
                ],
                '_account_page' => [
                    'label' => 'Account Page',
                    'type' => 'select_page',
                ],
                
                // Currency Settings
                '_currency' => [
                    'label' => 'Currency',
                    'type' => 'select',
                    'options' => [
                        'USD' => 'US Dollar ($)',
                        'EUR' => 'Euro (€)',
                        'GBP' => 'British Pound (£)',
                        'JPY' => 'Japanese Yen (¥)',
                        'INR' => 'Indian Rupee (₹)',
                        'CAD' => 'Canadian Dollar (C$)',
                        'AUD' => 'Australian Dollar (A$)',
                        'SGD' => 'Singapore Dollar (S$)',
                    ],
                    'default' => 'USD',
                ],
                '_currency_position' => [
                    'label' => 'Currency Position',
                    'type' => 'select',
                    'options' => [
                        'left' => 'Left ($99.99)',
                        'right' => 'Right (99.99$)',
                        'left_space' => 'Left with space ($ 99.99)',
                        'right_space' => 'Right with space (99.99 $)',
                    ],
                    'default' => 'left',
                ],
                '_thousand_separator' => [
                    'label' => 'Thousand Separator',
                    'type' => 'text',
                    'default' => ',',
                ],
                '_decimal_separator' => [
                    'label' => 'Decimal Separator',
                    'type' => 'text',
                    'default' => '.',
                ],
                '_number_of_decimals' => [
                    'label' => 'Number of Decimals',
                    'type' => 'select',
                    'options' => [
                        '0' => '0',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                    ],
                    'default' => '2',
                ],
                
                // Multi-Currency Settings
                '_enable_multi_currency' => [
                    'label' => 'Enable Multi-Currency',
                    'type' => 'checkbox',
                    'default' => 0,
                ],
                '_auto_update_exchange_rates' => [
                    'label' => 'Auto Update Exchange Rates',
                    'type' => 'checkbox',
                    'default' => 0,
                ],
                '_exchange_rate_api_key' => [
                    'label' => 'Exchange Rate API Key',
                    'type' => 'text',
                ],
                
                // Checkout Settings
                '_require_shipping_address' => [
                    'label' => 'Require Shipping Address',
                    'type' => 'checkbox',
                    'default' => 1,
                ],
                '_require_phone' => [
                    'label' => 'Require Phone Number',
                    'type' => 'checkbox',
                    'default' => 1,
                ],
                '_enable_guest_checkout' => [
                    'label' => 'Enable Guest Checkout',
                    'type' => 'checkbox',
                    'default' => 0,
                ],
                '_enable_coupons' => [
                    'label' => 'Enable Coupons',
                    'type' => 'checkbox',
                    'default' => 1,
                ],
                
                // Tax Settings
                '_enable_taxes' => [
                    'label' => 'Enable Taxes',
                    'type' => 'checkbox',
                    'default' => 0,
                ],
                '_tax_base' => [
                    'label' => 'Tax Calculation Based On',
                    'type' => 'select',
                    'options' => [
                        'billing' => 'Customer billing address',
                        'shipping' => 'Customer shipping address',
                        'shop' => 'Shop base address',
                    ],
                    'default' => 'billing',
                ],
                '_tax_display_cart' => [
                    'label' => 'Display Prices in Cart',
                    'type' => 'select',
                    'options' => [
                        'incl' => 'Including tax',
                        'excl' => 'Excluding tax',
                    ],
                    'default' => 'incl',
                ],
                
                // Email Settings
                '_email_new_order' => [
                    'label' => 'New Order Email',
                    'type' => 'checkbox',
                    'default' => 1,
                ],
                '_email_processing_order' => [
                    'label' => 'Processing Order Email',
                    'type' => 'checkbox',
                    'default' => 1,
                ],
                '_email_completed_order' => [
                    'label' => 'Completed Order Email',
                    'type' => 'checkbox',
                    'default' => 1,
                ],
                '_email_order_template' => [
                    'label' => 'Order Email Template',
                    'type' => 'textarea',
                ],
            ]
        );
    }
}