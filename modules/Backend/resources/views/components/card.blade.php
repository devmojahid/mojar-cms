<div class="card {{ $class ?? '' }}">
    @if($label ?? false)
        <div class="card-header">
                <h4 class="card-title">{{ $label }}</h5>
        </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</div>