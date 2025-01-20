<div class="d-flex align-items-center">
    {{-- Title with link --}}
    @if(!$title_hidden)
    <div class="flex-grow-1">
        <a href="{{ $editUrl }}" class="text-reset text-decoration-none fw-bold">{{ $value }}</a>
    </div>
    @endif

    {{-- Actions Dropdown --}}
    @if(!$actions_hidden && count($actions) > 0)
    <div class="dropdown">
        <button class="btn btn-tabler dropdown-toggle align-text-top" 
                data-bs-toggle="dropdown" 
                data-bs-theme-value="dark"
                aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots-vertical" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
            </svg>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            @foreach($actions as $key => $action)
                @php
                    $hasAction = !empty($action['action']);
                @endphp
                <a href="{{ $action['url'] ?? 'javascript:void(0)' }}"
                    @if(isset($action['target'])) target="{{ $action['target'] }}" @endif
                    class="dropdown-item jw-table-row {{ $action['class'] ?? '' }} {{ $hasAction ? 'action-item' : '' }}"
                    data-id="{{ $row->id ?? '' }}"
                    @if(!empty($action['target']))
                        target="{{ $action['target'] }}"
                    @endif
                    @if($hasAction) data-action="{{ $action['action'] }}" @endif
                    @foreach($action['data'] ?? [] as $dataKey => $item)
                        data-{{ $dataKey }}="{{ (string) $item }}"
                    @endforeach
                >
                    {{ $action['label'] ?? '' }}
                </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
