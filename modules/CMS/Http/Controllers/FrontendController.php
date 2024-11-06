<?php

namespace Mojar\CMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\View\View;
use Mojar\CMS\Abstracts\Action;
use Mojar\CMS\Facades\HookAction;
use Mojar\CMS\Facades\Theme;
use Mojar\CMS\Traits\ResponseMessage;
use Symfony\Component\HttpFoundation\Response;

class FrontendController extends Controller
{
    use ResponseMessage;

    protected string $template;

    public function callAction($method, $parameters): Response|string|View|\Inertia\Response
    {
        $this->template = Theme::currentTheme()->getTemplate();

        /**
         * Action after call action frontend
         * Add action to this hook add_action('frontend.call_action', $callback)
         */
        do_action(Action::FRONTEND_CALL_ACTION, $method, $parameters);

        do_action(Action::WIDGETS_INIT);

        do_action(Action::BLOCKS_INIT);

        return parent::callAction($method, $parameters);
    }

    protected function getPermalinks($base = null)
    {
        if ($base) {
            return collect(HookAction::getPermalinks())
                ->where('base', $base)
                ->first();
        }

        return collect(HookAction::getPermalinks());
    }

    protected function view($view, $params = []): Factory|ViewContract|string|\Inertia\Response
    {
        return Theme::render($view, $params);
    }
}
