<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Lms\Supports\Creaters;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Juzaweb\CMS\Models\User;

class OrderCreater
{
    public function create(array $data, array $items, User $user): Order
    {
        $items = collect($items);

        if ($items->isEmpty()) {
            throw new \Exception('Product items is empty.');
        }

        $paymentMethod = $this->getPaymentMethod($data);

        $filldata = array_except(
            $data,
            [
                'code',
                'payment_status',
                'delivery_status',
                'user_id',
                'total_price',
                'total',
                'quantity',
            ]
        );

        do_action('lms.before.save.order', $filldata, $items, $user);

    
        $order = new Order();
        $order->fill($filldata);
        $order->code = $this->generateOrderCode();
        $order->token = $this->generateOrderToken();
        $order->user_id = $user->id;
        $order->total_price = $items->sum('line_price');
        $order->total = $order->total_price;
        $order->quantity = $items->sum('quantity');
        $order->name = $user->name;
        $order->phone = $user->phone;
        $order->type = $items->first()['type'] ?? 'products';
        $order->email = $user->email;
        $order->payment_method_name = $paymentMethod->name;
        $order->save();


        do_action('lms.after.save.order', $order, $items, $user);

        foreach ($items as $item) {
            $order->orderItems()->create([
                'title' => $item['title'],
                'type' => $item['type'] ?? 'products',
                'thumbnail' => $item['thumbnail'],
                'price' => (float) $item['price'],
                'line_price' => (float) $item['line_price'], 
                'quantity' => (int) $item['quantity'],
                'compare_price' => (float) ($item['compare_price'] ?? 0),
                'sku_code' => $item['sku_code'] ?? null,
                'barcode' => $item['barcode'] ?? null,
                'post_id' => $item['post_id'] ?? null,
                'order_id' => $order->id
            ]);
        }

        return $order;
    }


    public function generateOrderCode(): string
    {
        $i=1;
        do {
            $code = date('YmdHis').$i;
            $i++;
        } while (Order::where('code', '=', $code)->exists());

        return $code;
    }

    public function generateOrderToken(): string
    {
        do {
            $token = Str::uuid()->toString();
        } while (Order::where('token', '=', $token)->exists());

        return $token;
    }

    protected function getPaymentMethod(array $data): PaymentMethod
    {
        $paymentMethod = PaymentMethod::find(
            Arr::get($data, 'payment_method_id')
        );

        if (empty($paymentMethod)) {
            throw new \Exception('Payment method does not exist');
        }

        return $paymentMethod;
    }
}
