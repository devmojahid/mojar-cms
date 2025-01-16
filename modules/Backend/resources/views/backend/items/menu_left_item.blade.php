@if ($submenu_item == true)
    <a class="dropdown-item @if ($active)active @endif" href="{{ $adminUrl . $item->getUrl() }}"
        @if ($item->get('turbolinks') === false) data-turbolinks="false" @endif>
        {{ $item->get('title') }}
    </a>
@else
    <li
        class="not_have_children nav-item mojar__menuLeft__item mojar__menuLeft__item-{{ $item->get('slug') }} @if ($active) active mojar__menuLeft__submenu--toggled @endif">
        <a class="nav-link mojar__menuLeft__item__link @if ($active) active mojar__menuLeft__item--active @endif"
            href="{{ $adminUrl . $item->getUrl() }}" @if ($item->get('turbolinks') === false) data-turbolinks="false" @endif>

            <span class="nav-link-icon d-md-none d-lg-inline-block">
                @if ($icon ?? true)
                    <i class="mojar__menuLeft__item__icon {{ $item->get('icon') }}"></i>
                @endif
            </span>

            <span class="nav-link-title">{{ $item->get('title') }}</span>
        </a>
    </li>
@endif
