@php
    use Mojahid\Ecommerce\Models\Currency;
    $currencies = Currency::all();
@endphp

<table class="table">
    <thead>
       <tr>
         <th>{{ __('Currency Code') }}</th>
         <th>{{ __('Symbol') }}</th>
         <th>{{ __('Exchange Rate') }}</th>
         <th>{{ __('Enabled') }}</th>
         <th>{{ __('Default') }}</th>
         <th></th>
       </tr>
    </thead>
    <tbody>
        @foreach($currencies as $currency)
        <tr>
            <td>
                <input type="text" name="currencies[{{ $currency->id }}][currency_code]" value="{{ $currency->currency_code }}">
            </td>
            <td>
                <input type="text" name="currencies[{{ $currency->id }}][symbol]" value="{{ $currency->symbol }}">
            </td>
            <td>
                <input type="text" name="currencies[{{ $currency->id }}][exchange_rate]" value="{{ $currency->exchange_rate }}">
            </td>
            <td>
                <input type="checkbox" name="currencies[{{ $currency->id }}][is_enabled]" {{ $currency->is_enabled ? 'checked' : '' }}>
            </td>
            <td>
                <input type="radio" name="default_currency_id" value="{{ $currency->id }}" {{ $currency->is_default ? 'checked' : '' }}>
            </td>
            <td>
                <button type="button" data-action="delete-currency" data-id="{{ $currency->id }}">x</button>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="6">
                <button type="button" id="add-new-currency">{{ __('Add New Currency') }}</button>
            </td>
        </tr>
    </tbody>
</table>