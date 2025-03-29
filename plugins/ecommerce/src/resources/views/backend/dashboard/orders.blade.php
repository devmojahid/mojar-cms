<div class="col-12 mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('ecommerce::app.recent_orders') }}</h3>
            <div class="card-actions">
                {{-- <a href="{{ route('admin.ecommerce.orders.index') }}" class="btn btn-primary"> --}}
                <a href="#" class="btn btn-primary">
                    {{ trans('cms::app.view_all') }}
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th>{{ trans('cms::app.id') }}</th>
                        <th>{{ trans('ecommerce::app.customer') }}</th>
                        <th>{{ trans('ecommerce::app.status') }}</th>
                        <th>{{ trans('ecommerce::app.total') }}</th>
                        <th>{{ trans('cms::app.created_at') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\Mojahid\Ecommerce\Models\Order::orderBy('created_at', 'DESC')->limit(5)->get() as $order)
                    <tr>
                        <td>
                            {{-- <a href="{{ route('admin.ecommerce.orders.edit', [$order->id]) }}">#{{ $order->id }}</a> --}}
                            <a href="#">#{{ $order->id }}</a>
                        </td>
                        <td>{{ $order->customer->name ?? 'N/A' }}</td>
                        <td>
                            <span class="badge bg-{{ $order->status_color }}">{{ $order->status_label }}</span>
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