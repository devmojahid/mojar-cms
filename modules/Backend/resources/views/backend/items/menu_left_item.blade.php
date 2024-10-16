{{-- <li class="nav-item juzaweb__menuLeft__item juzaweb__menuLeft__item-{{ $item->get('slug') }} @if ($active) juzaweb__menuLeft__submenu--toggled @endif">
    <a class="juzaweb__menuLeft__item__link @if ($active) juzaweb__menuLeft__item--active @endif" href="{{ $adminUrl . $item->getUrl() }}" @if ($item->get('turbolinks') === false) data-turbolinks="false" @endif>

        @if ($icon ?? true)
            <i class="juzaweb__menuLeft__item__icon {{ $item->get('icon') }}"></i>
        @endif

        <span class="juzaweb__menuLeft__item__title">{{ $item->get('title') }}</span>
    </a>
</li> --}}

{{-- <li
    class="nav-item juzaweb__menuLeft__item juzaweb__menuLeft__item-{{ $item->get('slug') }} @if ($active) active juzaweb__menuLeft__submenu--toggled @endif">
    <a class="nav-link juzaweb__menuLeft__item__link @if ($active) active juzaweb__menuLeft__item--active @endif"
        href="{{ $adminUrl . $item->getUrl() }}" @if ($item->get('turbolinks') === false) data-turbolinks="false" @endif>
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            @if ($icon ?? true)
                <i class="{{ $item->get('icon') }}"></i>
            @endif
        </span>
        <span class="nav-link-title juzaweb__menuLeft__item__title">
            {{ $item->get('title') }}
        </span>
    </a>
</li> --}}


{{-- dropdown-item --}}
{{-- <a href="{{ $adminUrl . $item->getUrl() }}" class="dropdown-item">
    @if ($icon ?? true)
        <i class="{{ $item->get('icon') }}"></i>
    @endif
    <span class="nav-link-title juzaweb__menuLeft__item__title">
        {{ $item->get('title') }}
    </span>
</a> --}}

@if ($item->hasChildren())
    <a href="{{ $adminUrl . $item->getUrl() }}" class="dropdown-item">
        @if ($icon ?? true)
            <i class="{{ $item->get('icon') }}"></i>
        @endif
        <span class="nav-link-title juzaweb__menuLeft__item__title">
            {{ $item->get('title') }}
        </span>
    </a>
@else
{{-- <a class="nav-link" href="./">
    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l-2 0l9 -9l9 9l-2 0"></path><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
    </span>
    <span class="nav-link-title">
      Home
    </span>
  </a> --}}
  <a href="{{ $adminUrl . $item->getUrl() }}" class="nav-link">
    @if ($icon ?? true)
        <i class="{{ $item->get('icon') }}"></i>
    @endif
    <span class="nav-link-title juzaweb__menuLeft__item__title">
        {{ $item->get('title') }}
    </span>
    </a>
@endif
