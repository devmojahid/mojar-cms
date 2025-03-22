<?php

namespace Mojahid\Lms\Http\Controllers\Backend;

use Juzaweb\CMS\Http\Controllers\BackendController;
use Mojahid\Ecommerce\Models\PaymentMethod;
use Juzaweb\CMS\Traits\ResourceController;
use Mojahid\Lms\Http\Datatables\OrderDatatable;
use Mojahid\Lms\Models\Order;
use Illuminate\Support\Facades\Validator;

class OrderController extends BackendController
{
    use ResourceController {
        getDataForForm as DataForForm;
    }

    protected string $viewPrefix = 'lms::backend.orders';


    protected function getDataTable(...$params): OrderDatatable
    {
        return new OrderDatatable();
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
            Order::PAYMENT_STATUS_COMPLETED => trans('lms::content.completed'),
            Order::PAYMENT_STATUS_PENDING => trans('lms::content.pending')
        ];
        return $data;

    }

    protected function getModel(...$params): string
    {
        return Order::class;
    }


    protected function getTitle(...$params): string
    {
        return trans('lms::content.orders');
    }

}