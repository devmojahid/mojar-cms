@foreach ($widgets as $widget)
    @php
        $widgetData = \Mojar\CMS\Facades\HookAction::getWidgets($widget['widget'] ?? 'null');
    @endphp

    @if (empty($widgetData))
        @continue
    @endif

    {!! $sidebar->get('before_widget') !!}

    {!! $widgetData['widget']->show($widget) !!}

    {!! $sidebar->get('after_widget') !!}
@endforeach
