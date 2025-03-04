<?php

namespace Mojahid\Ecommerce\Http\Controllers\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Juzaweb\CMS\Traits\ResourceController;
use Mojahid\Ecommerce\Http\Datatables\OrderDatatable;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Models\PaymentMethod;

class OrderController extends BackendController
{
    use ResourceController {
        getDataForForm as DataForForm;
    }

    protected string $viewPrefix = 'ecomm::backend.order';

    protected function getDataTable(...$params): OrderDatatable
    {
        return new OrderDatatable();
    }

    protected function validator(array $attributes, ...$params): \Illuminate\Validation\Validator
    {
        return Validator::make(
            $attributes,
            [
                'title' => 'nullable|string|max:250',
                'type' => 'required|string|max:50',
                'status' => 'required|string|in:' . implode(',', array_keys($this->getStatuses())),
                'code' => 'required|string|max:150|unique:orders,code,' . ($params[0] ?? null),
                'name' => 'required|string|max:150',
                'email' => 'nullable|email|max:150',
                'phone' => 'nullable|string|max:50',
                'address' => 'nullable|string',
                'country_code' => 'nullable|string|max:15',
                'quantity' => 'required|integer|min:1',
                'total_price' => 'required|numeric|min:0',
                'total' => 'required|numeric|min:0',
                'discount' => 'nullable|numeric|min:0',
                'discount_codes' => 'nullable|string|max:150',
                'payment_method_id' => 'nullable|exists:payment_methods,id',
                'payment_method_name' => 'required|string|max:250',
                'payment_status' => 'required|string|in:' . implode(',', array_keys($this->getPaymentStatuses())),
                'delivery_status' => 'required|string|in:' . implode(',', array_keys($this->getDeliveryStatuses())),
                'notes' => 'nullable|string',
                'user_id' => 'nullable|exists:users,id',
                'meta' => 'nullable|array'
            ]
        );
    }

    protected function getDataForForm($model, ...$params): array
    {
        $data = $this->DataForForm($model, $params);
        
        $data['paymentMethods'] = PaymentMethod::get(['id', 'name'])
            ->mapWithKeys(
                function ($item) {
                    return [$item->id => $item->name];
                }
            )->toArray();

        $data['statuses'] = $this->getStatuses();
        $data['paymentStatuses'] = $this->getPaymentStatuses();
        $data['deliveryStatuses'] = $this->getDeliveryStatuses();
        
        return $data;
    }

    protected function beforeSave(array $data, $model, ...$params): array
    {
        if (empty($data['title'])) {
            $data['title'] = "Order #{$data['code']}";
        }

        if (empty($data['type'])) {
            $data['type'] = 'ecommerce';
        }

        return $data;
    }

    protected function afterSave($data, $model, ...$params): void
    {
        parent::afterSave($data, $model, ...$params);

        if (isset($data['meta'])) {
            $model->syncMetasWithoutDetaching($data['meta']);
        }

        do_action('order.after_save', $model, $data);
    }

    public function updateStatus(Request $request, $id): JsonResponse
    {
        $order = Order::findOrFail($id);
        $status = $request->input('status');
        $type = $request->input('type', 'status');

        DB::beginTransaction();
        try {
            switch ($type) {
                case 'payment':
                    if (!array_key_exists($status, $this->getPaymentStatuses())) {
                        throw new \Exception('Invalid payment status.');
                    }
                    $order->update(['payment_status' => $status]);
                    break;
                case 'delivery':
                    if (!array_key_exists($status, $this->getDeliveryStatuses())) {
                        throw new \Exception('Invalid delivery status.');
                    }
                    $order->update(['delivery_status' => $status]);
                    break;
                default:
                    if (!array_key_exists($status, $this->getStatuses())) {
                        throw new \Exception('Invalid status.');
                    }
                    $order->update(['status' => $status]);
            }

            do_action('order.update_status', $order, $status, $type);
            
            DB::commit();

            return $this->success([
                'message' => trans('cms::app.updated_successfully')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error([
                'message' => $e->getMessage()
            ]);
        }
    }

    protected function getModel(...$params): string
    {
        return Order::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('ecomm::content.orders');
    }

    private function getStatuses(): array
    {
        return [
            Order::STATUS_PENDING => trans('ecomm::content.pending'),
            Order::STATUS_PROCESSING => trans('ecomm::content.processing'),
            Order::STATUS_COMPLETED => trans('ecomm::content.completed'),
            Order::STATUS_CANCELLED => trans('ecomm::content.cancelled'),
        ];
    }

    private function getPaymentStatuses(): array
    {
        return [
            Order::PAYMENT_STATUS_PENDING => trans('ecomm::content.pending'),
            Order::PAYMENT_STATUS_COMPLETED => trans('ecomm::content.completed'),
            Order::PAYMENT_STATUS_FAILED => trans('ecomm::content.failed'),
        ];
    }

    private function getDeliveryStatuses(): array
    {
        return [
            Order::DELIVERY_STATUS_PENDING => trans('ecomm::content.pending'),
            Order::DELIVERY_STATUS_PROCESSING => trans('ecomm::content.processing'),
            Order::DELIVERY_STATUS_SHIPPED => trans('ecomm::content.shipped'),
            Order::DELIVERY_STATUS_DELIVERED => trans('ecomm::content.delivered'),
        ];
    }
}
