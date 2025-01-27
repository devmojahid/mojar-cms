<div class="form-group">
    <label class="jw__utils__control jw__utils__control__checkbox form-label">
        <input
            type="checkbox"
            name="{{ $name }}"
            class="{{ $class ?? '' }} form-check-input"
            id="{{ $id ?? $name }}"
            value="{{ $value ?? $default ?? '1' }}"
            autocomplete="off"
            placeholder="{{ $placeholder ?? '' }}"
            @if($checked ?? false) checked @endif
            @if($disabled ?? false) disabled @endif
            @if($required ?? false) required @endif
            @if ($readonly ?? false) readonly @endif
            @foreach ($data ?? [] as $key => $val)
                {{ 'data-' . $key. '="'. $val .'"' }}
            @endforeach
        >

        <span class="jw__utils__control__indicator"></span>
        {{ $label ?? $name }}

        @if($description ?? false)
        <br>
        <small class="form-hint">{!! $description !!}</small>
        @endif
    </label>
</div>