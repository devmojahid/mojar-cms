<div class="form-group mb-3">
    @php $path = $value ?? null; @endphp
    <div class="form-image text-center @if($path) previewing @endif">
        <!-- Original Clear Button -->
        <a href="javascript:void(0)" class="image-clear position-absolute top-0 end-0 m-2 z-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>    
        </a>

        <!-- Original Hidden Input -->
        <input type="hidden" name="{{ $name }}" class="input-path" value="{{ $path }}">

        <!-- Original Preview with Enhanced Styling -->
        <div class="dropify-preview image-hidden position-relative rounded-3 overflow-hidden" @if($path) style="display: block" @endif>
            <span class="dropify-render">
                @if(!empty($path))
                <img src="{{ upload_url($path) }}" alt="" class="img-fluid w-100 h-100 object-fit-cover">
                @endif
            </span>
            <div class="dropify-infos position-absolute bottom-0 start-0 w-100 bg-opacity-75 bg-dark text-white p-2">
                <div class="dropify-infos-inner">
                    <p class="dropify-filename mb-0">
                        <span class="dropify-filename-inner"></span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Enhanced Upload Area -->
        <div class="upload-area d-flex flex-column align-items-center justify-content-center p-4 rounded-3">
            <div class="icon-wrapper mb-3">
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
    </div>
</div>