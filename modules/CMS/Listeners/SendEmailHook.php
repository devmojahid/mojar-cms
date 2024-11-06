<?php

namespace Mojar\CMS\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Arr;
use Mojar\CMS\Events\EmailHook;
use Mojar\Backend\Models\EmailTemplate;
use Mojar\CMS\Support\Email;

class SendEmailHook implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param EmailHook $event
     * @return void
     */
    public function handle(EmailHook $event): void
    {
        $params = $event->args['params'] ?? [];
        $templates = EmailTemplate::with(['users' => fn($q) => $q->select(['email'])])
            ->where(['email_hook' => $event->hook, 'active' => true])
            ->get();

        foreach ($templates as $template) {
            $to = [];
            if ($template->to_sender && $senders = Arr::get($event->args, 'to')) {
                if (!is_array($senders)) {
                    $senders = [$senders];
                }

                $to = array_merge($to, $senders);
            }

            $to = array_merge($to, $template->users->pluck('email')->toArray());
            $to = array_merge($to, $template->to_emails ?? []);

            if (empty($to)) {
                continue;
            }

            Email::make()
                ->setEmails($to)
                ->withTemplate($template->code)
                ->setParams($params)
                ->send();
        }
    }
}
