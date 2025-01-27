<div class="form-group">
    <label class="form-label" for="{{ $id ?? $name }}">
        {{ $label ?? $name }} @if ($required ?? false)
            <abbr>*</abbr>
        @endif
    </label>
    <div class="row">
        <div class="col-md-9">
            <input type="text" name="{{ $name }}" class="form-control" id="{{ $id ?? $name }}"
                value="{{ $value ?? ($default ?? '') }}" autocomplete="off"
                @if ($required ?? false) required @endif>
        </div>

        <div class="col-md-3">
            <a href="javascript:void(0)" class="btn btn-tabler file-manager" data-input="{{ $id ?? $name }}"
                data-type="{{ $type ?? 'file' }}" data-disk="{{ $disk ?? config('mojar.filemanager.disk') }}">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-upload"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 9l5 -5l5 5" /><path d="M12 4l0 12" /></svg>
                </span>
                {{ trans('cms::app.upload') }}
            </a>
        </div>
    </div>
</div>
