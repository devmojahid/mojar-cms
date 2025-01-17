{{-- <div class="form-group">
    @php
        $path = $value ?? null;
    @endphp
    <div class="form-image text-center @if($path) previewing @endif">

        <a href="javascript:void(0)" class="image-clear">
            <i class="fa fa-times-circle fa-2x"></i>
        </a>

        <input type="hidden" name="{{ $name }}" class="input-path" value="{{ $path }}">

        <div class="dropify-preview image-hidden" @if($path) style="display: block" @endif>
            <span class="dropify-render">
                @if(!empty($path))
                <img src="{{ upload_url($path) }}" alt="">
                @endif
            </span>
            <div class="dropify-infos">
                <div class="dropify-infos-inner">
                    <p class="dropify-filename">
                        <span class="dropify-filename-inner"></span>
                    </p>
                </div>
            </div>
        </div>

        <div class="icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-library-photo">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
              <path d="M7 3m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
              <path d="M4.012 7.26a2.005 2.005 0 0 0 -1.012 1.737v10c0 1.1 .9 2 2 2h10c.75 0 1.158 -.385 1.5 -1" />
              <path d="M17 7h.01" />
              <path d="M7 13l3.644 -3.644a1.21 1.21 0 0 1 1.712 0l3.644 3.644" />
              <path d="M15 12l1.644 -1.644a1.21 1.21 0 0 1 1.712 0l2.644 2.644" />
            </svg>
        </div>
    </div>
</div> --}}

<div class="form-group">
    @php
        $path = $value ?? null;
    @endphp
    <div class="form-image text-center @if($path) previewing @endif position-relative border p-3 rounded shadow-sm">
        <!-- Clear Button -->
        <a href="javascript:void(0)" class="image-clear text-danger position-absolute" style="top: 10px; right: 10px;">
            <i class="fa fa-times-circle fa-2x"></i>
        </a>

        <!-- Hidden Input -->
        <input type="hidden" name="{{ $name }}" class="input-path" value="{{ $path }}">

        <!-- Preview Section -->
        <div class="dropify-preview image-hidden @if($path) d-block @else d-none @endif">
            <span class="dropify-render d-block mb-2">
                @if(!empty($path))
                    <img src="{{ upload_url($path) }}" alt="Preview" class="img-fluid rounded" style="max-height: 150px;">
                @else
                    <p class="text-muted">No image selected</p>
                @endif
            </span>
            <div class="dropify-infos">
                <div class="dropify-infos-inner">
                    <p class="dropify-filename">
                        <span class="dropify-filename-inner"></span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Placeholder Icon -->
        <div class="icon-wrapper @if($path) d-none @endif">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-library-photo">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M7 3m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                <path d="M4.012 7.26a2.005 2.005 0 0 0 -1.012 1.737v10c0 1.1 .9 2 2 2h10c.75 0 1.158 -.385 1.5 -1" />
                <path d="M17 7h.01" />
                <path d="M7 13l3.644 -3.644a1.21 1.21 0 0 1 1.712 0l3.644 3.644" />
                <path d="M15 12l1.644 -1.644a1.21 1.21 0 0 1 1.712 0l2.644 2.644" />
            </svg>
        </div>
    </div>
</div>