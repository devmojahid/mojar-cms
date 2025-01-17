<div class="form-group">
    <label class="form-label @if($required ?? false)required @endif" for="{{ $id  ?? $name }}">
        {{ $label ?? $name }}
    </label>

    @if(isset($prefix) || isset($suffix))
        <div class="input-group mb-2">
            @if(isset($prefix))
                <div class="input-group-prepend">
                    <div class="input-group-text">{{ $prefix }}</div>
                </div>
            @endif

            <input
                type="{{ $type ?? 'text' }}"
                name="{{ $name }}"
                class="form-control {{ $class ?? '' }}"
                id="{{ $id ?? $name }}"
                value="{{ $value ?? $default ?? '' }}"
                autocomplete="off"
                placeholder="{{ $placeholder ?? '' }}"
                @if($disabled ?? false) disabled @endif
                @if($required ?? false) required @endif
                @if ($readonly ?? false) readonly @endif
                @foreach ($data ?? [] as $key => $val)
                {{ 'data-' . $key. '="'. $val .'"' }}
                @endforeach
            />

            @if(isset($suffix))
                <div class="input-group-prepend">
                    <div class="input-group-text">{{ $suffix }}</div>
                </div>
            @endif
        </div>
    @else
        <input
            type="{{ $type ?? 'text' }}"
            name="{{ $name }}"
            class="form-control {{ $class ?? '' }}"
            id="{{ $id ?? $name }}"
            value="{{ $value ?? $default ?? '' }}"
            autocomplete="off"
            placeholder="{{ $placeholder ?? '' }}"
            @if($disabled ?? false) disabled @endif
            @if($required ?? false) required @endif
            @if ($readonly ?? false) readonly @endif
        @foreach ($data ?? [] as $key => $val)
            {{ 'data-' . $key. '="'. $val .'"' }}
            @endforeach
        />
    @endif
</div>
