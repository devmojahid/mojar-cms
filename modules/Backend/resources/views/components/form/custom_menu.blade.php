@php
    $menus = Juzaweb\Backend\Models\Menu::all();
@endphp

<div class="form-group">
    <label class="form-label @if($required ?? false)required @endif" for="{{ $id  ?? $name }}">
        {{ $label ?? $name }}
    </label>

    <select name="{{ $name }}" class="load-menu">
        @foreach ($menus as $menu)
            <option value="{{ $menu->id }}" {{ $value == $menu->id ? 'selected' : '' }}>{{ $menu->name }}</option>
        @endforeach
    </select>
</div>
