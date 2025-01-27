@php
    $paths = $value ?? [];
@endphp

    <div class="form-images">
        <input type="hidden" class="input-name" value="{{ $name }}[]">
        <div class="images-list">
            @foreach($paths as $path)
                @component('cms::components.image-item', [
                    'name' => "{$name}[]",
                    'path' => $path,
                    'url' => upload_url($path),
                ])

                @endcomponent
            @endforeach

            <div class="image-item border">
                <a href="javascript:void(0)" class="text-secondary add-image-images">
                    <span>
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    </span>
                </a>
            </div>
        </div>
    </div>