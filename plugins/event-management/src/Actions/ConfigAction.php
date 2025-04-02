<?php

namespace Mojahid\EventManagement\Actions;

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
                'evman_store_address1' => [
                    'label' => 'Store Address Line 1',
                    'type' => 'text',
                ],
                'evman_store_address2' => [
                    'label' => 'Store Address Line 2',
                    'type' => 'text',
                ],
                'evman_city' => [
                    'label' => 'City',
                    'type' => 'text',
                ],
                'evman_country' => [
                    'label' => 'Country',
                    'type' => 'select',
                ],
                'evman_zipcode' => [
                    'label' => 'Zipcode',
                    'type' => 'text',
                ],
                'evman_event_default_status' => [
                    'label' => 'Default Event Status',
                    'type' => 'select',
                    'options' => [
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'draft' => 'Draft',
                    ],
                    'default' => 'active',
                ],
                'evman_ticket_default_status' => [
                    'label' => 'Default Ticket Status',
                    'type' => 'select',
                    'options' => [
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ],
                    'default' => 'active',
                ],
                'evman_checkout_page' => [
                    'label' => 'Checkout Page',
                    'type' => 'select_page',
                ],
                'evman_thanks_page' => [
                    'label' => 'Thank You Page',
                    'type' => 'select_page',
                ],
                'evman_ticket_prefix' => [
                    'label' => 'Ticket Code Prefix',
                    'type' => 'text',
                    'default' => 'EVT-',
                ],
                'evman_email_notification' => [
                    'label' => 'Email Notification',
                    'type' => 'checkbox',
                    'default' => 1,
                ],
                'evman_booking_expiry_time' => [
                    'label' => 'Booking Expiry Time (minutes)',
                    'type' => 'number',
                    'default' => 30,
                ],
                'evman_date_format' => [
                    'label' => 'Date Format',
                    'type' => 'select',
                    'options' => [
                        'Y-m-d' => 'YYYY-MM-DD',
                        'd-m-Y' => 'DD-MM-YYYY',
                        'm/d/Y' => 'MM/DD/YYYY',
                    ],
                    'default' => 'Y-m-d',
                ],
                'evman_time_format' => [
                    'label' => 'Time Format',
                    'type' => 'select',
                    'options' => [
                        'H:i' => '24 Hour',
                        'h:i A' => '12 Hour',
                    ],
                    'default' => 'H:i',
                ],
            ]
        );
    }
}