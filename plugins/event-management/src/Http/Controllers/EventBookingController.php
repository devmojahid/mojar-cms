<?php

namespace Mojahid\EventManagement\Http\Controllers;

use Juzaweb\CMS\Http\Controllers\BackendController;
use Mojahid\Ecommerce\Models\PaymentMethod;
use Juzaweb\CMS\Traits\ResourceController;
use Mojahid\EventManagement\Http\Datatables\EventDatatable;
use Mojahid\EventManagement\Models\EventBooking;
use Illuminate\Support\Facades\Validator;

class EventBookingController extends BackendController
{
    use ResourceController {
        getDataForForm as DataForForm;
    }

    protected string $viewPrefix = 'evman::backend.event-booking';


    protected function getDataTable(...$params): EventDatatable
    {
        return new EventDatatable();
    }



    protected function validator(array $attributes, ...$params): \Illuminate\Validation\Validator
    {
        return Validator::make(
            $attributes,
            [
                // Rules
            ]
        );
    }

    protected function getDataForForm($model, ...$params): array
    {
        $data = $this->DataForForm($model, $params);
        $data['paymentMethods'] = PaymentMethod::get(['id', 'name'])->mapWithKeys(
            function ($item) {
                return [$item->id => $item->name];
            }
        )->toArray();
        $data['statuses'] = [
            EventBooking::PAYMENT_STATUS_COMPLETED => trans('evman::content.completed'),
            EventBooking::PAYMENT_STATUS_PENDING => trans('evman::content.pending')
        ];
        return $data;

    }

    protected function getModel(...$params): string
    {
        return EventBooking::class;
    }


    protected function getTitle(...$params): string
    {
        return trans('evman::content.event_bookings');
    }

}