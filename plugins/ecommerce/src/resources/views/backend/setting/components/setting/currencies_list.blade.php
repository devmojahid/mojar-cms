@php
  use Mojahid\Ecommerce\Models\Currency;
  $currencies = Currency::orderBy('code')->get();
@endphp

<table class="table table-bordered" id="currency-table">
  <thead>
    <tr>
      <th>{{ __('Code') }}</th>
      <th>{{ __('Name') }}</th>
      <th>{{ __('Symbol') }}</th>
      <th>{{ __('Exchange Rate') }}</th>
      <th>{{ __('Enabled') }}</th>
      <th>{{ __('Default') }}</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  @foreach($currencies as $c)
    <tr>
      <td>
        <input type="text" name="currencies[{{ $c->id }}][code]" value="{{ $c->code }}" class="form-control">
      </td>
      <td>
        <input type="text" name="currencies[{{ $c->id }}][name]" value="{{ $c->name }}" class="form-control">
      </td>
      <td>
        <input type="text" name="currencies[{{ $c->id }}][symbol]" value="{{ $c->symbol }}" class="form-control">
      </td>
      <td>
        <input type="text" name="currencies[{{ $c->id }}][exchange_rate]" value="{{ $c->exchange_rate }}" class="form-control">
      </td>
      <td class="text-center">
        <input type="checkbox" name="currencies[{{ $c->id }}][is_enabled]" {{ $c->is_enabled ? 'checked' : '' }}>
      </td>
      <td class="text-center">
        <input type="radio" name="default_currency_id" value="{{ $c->id }}" {{ $c->is_default ? 'checked' : '' }}>
      </td>
      <td>
        <button type="button" class="btn btn-sm btn-danger" data-action="delete-currency" data-id="{{ $c->id }}">x</button>
      </td>
    </tr>
  @endforeach
    <!-- row to add new currency dynamically -->
    <tr>
      <td colspan="7">
        <button type="button" id="add-new-currency" class="btn btn-sm btn-secondary">
          {{ __('Add New Currency') }}
        </button>
      </td>
    </tr>
  </tbody>
</table>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const tableBody = document.querySelector('#currency-table tbody');
  const addBtn = document.getElementById('add-new-currency');

  addBtn.addEventListener('click', function() {
    const randomId = 'new_'+Date.now();
    const row = document.createElement('tr');
    row.innerHTML = `
      <td><input type="text" name="currencies[${randomId}][code]" class="form-control"></td>
      <td><input type="text" name="currencies[${randomId}][name]" class="form-control"></td>
      <td><input type="text" name="currencies[${randomId}][symbol]" class="form-control"></td>
      <td><input type="text" name="currencies[${randomId}][exchange_rate]" value="1" class="form-control"></td>
      <td class="text-center">
        <input type="checkbox" name="currencies[${randomId}][is_enabled]" checked>
      </td>
      <td class="text-center">
        <input type="radio" name="default_currency_id" value="${randomId}">
      </td>
      <td>
        <button type="button" class="btn btn-sm btn-danger" data-action="remove-row">x</button>
      </td>
    `;
    tableBody.insertBefore(row, tableBody.lastElementChild);
  });

  // handle removing rows
  tableBody.addEventListener('click', function(e) {
    if (e.target.matches('[data-action="remove-row"]')) {
      e.target.closest('tr').remove();
    }
    if (e.target.matches('[data-action="delete-currency"]')) {
      // If you want immediate removal from DB, you'd handle it in your save method or mark for removal
      e.target.closest('tr').remove();
    }
  });
});
</script>
