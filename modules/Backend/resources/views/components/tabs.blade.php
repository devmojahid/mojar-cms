<div class="card mt-3 mb-3">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            @php
                $index = 0;
                $tabs = $tabs ?? [];
            @endphp
            @foreach ($tabs as $key => $tab)
                <li class="nav-item">
                    <a href="#{{ $key }}-tab" class="nav-link @if ($index == 0) active @endif"
                        id="{{ $key }}-label" data-toggle="tab" role="tab"
                        data-turbolinks="false">
                        <span>
                            {!! $tab['icon'] ?? '' !!}
                        </span>
                        {{ $tab['label'] ?? $tab }}
                    </a>
                    @php
                        $index++;
                    @endphp
                </li>
            @endforeach
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            @php
                $index = 0;
            @endphp
            @foreach ($tabs as $key => $tab)
                <div class="tab-pane p-3 @if ($index == 0) active @endif" id="{{ $key }}-tab"
                    role="tabpanel" aria-labelledby="{{ $key }}-label">
                    {{ ${'tab_' . $key} ?? '' }}
                    @php
                        $index++;
                    @endphp
                </div>
            @endforeach
        </div>
    </div>
</div>
