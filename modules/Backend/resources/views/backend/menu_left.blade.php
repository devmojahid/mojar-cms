<ul class="navbar-nav pt-lg-3">
    @php
        use Juzaweb\CMS\Facades\HookAction;
        use Juzaweb\CMS\Support\MenuCollection;

        global $jw_user;
        $adminPrefix = config('mojar.admin_prefix');
        $adminUrl = url($adminPrefix);
        $currentUrl = url()->current();
        $segment3 = request()->segment(3);
        $segment2 = request()->segment(2);
        $items = MenuCollection::make(apply_filters('get_admin_menu', HookAction::getAdminMenu()));
    @endphp

    @foreach ($items as $item)
        @if ($item->get('key') != 'dashboard' && !$jw_user->canAny($item->get('permissions', ['admin'])))
            @continue
        @endif

        @if ($item->hasChildren())
            @php
                $strChild = '';
                $hasActive = false;
                foreach ($item->getChildrens() as $child) {
                    if (!$jw_user->canAny($child->get('permissions', ['admin']))) {
                        continue;
                    }

                    if (empty($segment2)) {
                        $active = empty($child->getUrl());
                    } else {
                        $active = request()->is($adminPrefix . '/' . $child->get('url') . '*');
                    }

                    if ($active) {
                        $hasActive = true;
                    }

                    $strChild .= view('cms::backend.items.menu_left_item', [
                        'adminUrl' => $adminUrl,
                        'item' => $child,
                        'active' => $active,
                        'icon' => false,
                        'submenu_item' => true,
                    ])->render();
                }
            @endphp

            <li
                class="Have_children nav-item dropdown mojar__menuLeft__item mojar__menuLeft__submenu mojar__menuLeft__item-{{ $item->get('slug') }} @if ($hasActive) active mojar__menuLeft__submenu--toggled @endif">
                <a class="nav-link dropdown-toggle @if ($hasActive) show @endif" href="#navbar-help"
                    data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="{{ $item->get('icon') }}"></i>
                    </span>
                    <span class="nav-link-title">
                        {{ $item->get('title') }}
                    </span>
                </a>

                <div class="dropdown-menu @if ($hasActive) show @endif">
                    <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                            {!! $strChild !!}
                        </div>
                    </div>
                </div>
            </li>
        @else
            @component('cms::backend.items.menu_left_item', [
                'adminUrl' => $adminUrl,
                'item' => $item,
                'active' =>
                    $item->get('url') == 'dashboard'
                        ? request()->is($adminPrefix)
                        : request()->is($adminPrefix . '/' . $item->get('url') . '*'),
                'submenu_item' => false,
            ])
            @endcomponent
        @endif
    @endforeach
</ul>
