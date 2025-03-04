<?php

namespace Mojahid\ContactForm\Actions;

use Juzaweb\CMS\Abstracts\Action;

class MenuAction extends Action
{
    /**
     * Execute the actions.
     *
     * @return void
     */
    public function handle(): void
    {
        // $this->addAction(Action::INIT_ACTION, [$this, 'registerResources']);
        // $this->addAction('resource.contact-forms.form_left', [$this, 'formContactForm']);
        $this->addAction(Action::BACKEND_INIT, [$this, 'registerMenus']);
        $this->addAction(Action::INIT_ACTION, [$this, 'registerPostTypes']);
    }

    public function registerPostTypes(): void
    {
        //
    }

    public function formContactForm(): void
    {
        echo e(view('contact_form::contact-form.form'));
    }

    public function registerResources(): void
    {
        $this->registerResource(
            'contact-forms',
            null,
            [
                'label' => __('Contact Form'),
                'menu' => [
                    'icon' => 'fa fa-envelope',
                    'parent' => 'contact-form',
                ],
                'fields' => [
                    'title' => [
                        'type' => 'text',
                        'label' => __('Form Name'),
                    ],
                ],
                'metas' => [],
            ]
        );
    }

    public function registerResource(string $name, ?string $parent = null, array $options = []): void
    {
        $this->hookAction->registerResource($name, $parent, $options);
    }

    public function registerMenus(): void
    {
        // $this->addAdminMenu(
        //     __('Contact Form'),
        //     'contact-form',
        //     [
        //         'icon' => 'fa fa-envelope',
        //     ]
        // );

        $this->hookAction->registerAdminPage(
            'contacts',
            [
                'title' => __('Contacts'),
                'menu' => [
                    'icon' => 'fa fa-envelope',
                    'position' => 60,
                ],
            ]
        );
    }
}
