<?php

namespace Mojahid\Ecommerce\Supports\Manager;

class ToastManager
{
    public function show($message, $title = null, $type = 'info', $duration = 5000)
    {
        $toast = [
            'message' => $message,
            'title' => $title ?? ucfirst($type),
            'type' => $type,
            'duration' => $duration
        ];

        session()->flash('toast_notification', $toast);
    }

    public function success($message, $title = null, $duration = 5000)
    {
        $this->show($message, $title, 'success', $duration);
    }

    public function warning($message, $title = null, $duration = 5000)
    {
        $this->show($message, $title, 'warning', $duration);
    }

    public function error($message, $title = null, $duration = 5000)
    {
        $this->show($message, $title, 'error', $duration);
    }

    public function info($message, $title = null, $duration = 5000)
    {
        $this->show($message, $title, 'info', $duration);
    }
}
