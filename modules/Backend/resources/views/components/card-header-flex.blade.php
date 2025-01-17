<div class="card {{ $class ?? '' }}">
    @if($label ?? false)
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title">{{ $label }}</h5>
                </div>
                <div class="col-md-6">
                    {{ $action }}
                </div>
            </div>
        </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</div>