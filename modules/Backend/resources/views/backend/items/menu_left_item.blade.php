
@if($submenu_item == true)
    <a  class="dropdown-item" href="{{ $adminUrl . $item->getUrl() }}" @if($item->get('turbolinks') === false) data-turbolinks="false" @endif>
        {{ $item->get('title') }}
  </a>
@else
    <li class="not_have_children nav-item juzaweb__menuLeft__item juzaweb__menuLeft__item-{{ $item->get('slug') }} @if($active) juzaweb__menuLeft__submenu--toggled @endif">
        <a class="nav-link juzaweb__menuLeft__item__link @if($active) juzaweb__menuLeft__item--active @endif" href="{{ $adminUrl . $item->getUrl() }}" @if($item->get('turbolinks') === false) data-turbolinks="false" @endif>
            
            <span class="nav-link-icon d-md-none d-lg-inline-block">
            @if($icon ?? true)
                <i class="juzaweb__menuLeft__item__icon {{ $item->get('icon') }}"></i>
            @endif
            </span>

            <span class="nav-link-title">{{ $item->get('title') }}</span>
        </a>
    </li>
@endif