<div class="form-group">
    <input type="hidden" name="{{ $name }}" value="0">
    <label class="jw__utils__control jw__utils__control__checkbox form-label">
        <input
            type="checkbox"
            name="{{ $name }}"
            class="{{ $class ?? '' }} form-check-input"
            id="{{ $id ?? $name }}"
            value="1" 
            autocomplete="off"
            placeholder="{{ $placeholder ?? '' }}"
            @if($value ?? false) checked @endif
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