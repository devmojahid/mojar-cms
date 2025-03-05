@php
    if (!isset($action)) {
        $currentUrl = url()->current();
        if (isset($model)) {
            $action = $model->id ? str_replace('/edit', '', $currentUrl) : str_replace('/create', '', $currentUrl);
        } else {
            $action = '';
        }
    }

    if (!isset($method)) {
        if (isset($model)) {
            $method = $model->id ? 'put' : 'post';
        } else {
            $method = 'post';
        }
    }
@endphp

<form action="{{ $action }}" method="post" class="form-ajax">
    @csrf

    @if ($method == 'put')
        @method('PUT')
    @endif
    <div class="card">

        <div class="card-header bg-transparent justify-content-end align-items-center d-flex">
            @if (isset($cardTitle) && $cardTitle)
                <div class="me-auto">
                    <h5 class="card-title">{{ $cardTitle }}</h5>
                </div>
            @endif
            <div class="actions-buttons">
                <button type="submit" class="btn btn-tabler me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" <svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M14 4l0 4l-6 0l0 -4" />
                    </svg>
                    {{ trans('cms::app.save') }}
                </button>
                <button type="reset" class="btn btn-teal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                    </svg>
                    {{ trans('cms::app.reset') }}
                </button>
            </div>
        </div>
        <div class="card-body">
            {{ $slot ?? '' }}
        </div>
    </div>
</form>
