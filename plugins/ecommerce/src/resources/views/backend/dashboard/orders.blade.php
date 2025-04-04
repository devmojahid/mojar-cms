<div class="col-12 mt-3" style="padding: 0px !important;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('ecomm::content.recent_orders') }}</h3>
            <div class="card-actions">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">
                    {{ trans('ecomm::content.view_all') }}
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th>{{ trans('ecomm::content.id') }}</th>
                        <th>{{ trans('ecomm::content.customer') }}</th>
                        <th>{{ trans('ecomm::content.customer_email') }}</th>
                        <th>{{ trans('ecomm::content.status') }}</th>
                        <th>{{ trans('ecomm::content.total') }}</th>
                        <th>{{ trans('cms::app.created_at') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\Mojahid\Ecommerce\Models\Order::orderBy('created_at', 'DESC')->limit(5)->get() as $order)
                    <tr>
                        <td>
                            <a href="{{ route('admin.orders.edit', [$order->id]) }}">#{{ $order->id }}</a>
                        </td>
                        <td>{{ $order->name ?? 'N/A' }}</td>
                        <td>{{ $order->email ?? 'N/A' }}</td>
                        <td>
                            <span class="badge bg-{{ $order->status_color }}">{{ $order->status }}</span>
                        </td>
                        <td>{{ ecom_price_with_unit($order->total) }}</td>
                        <td>{{ jw_date_format($order->created_at) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>