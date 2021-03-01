<?php

declare(strict_types=1);

namespace InpsydeUsers;

class Endpoint
{
    public function __construct()
    {
        add_action('template_redirect', [$this, 'createArbitraryUrl']);
        add_filter('pre_get_document_title', [$this, 'replaceTitle'], 999, 1);
    }

    /**
     * Set custom page title for arbitrary URL.
     * @param string $title
     *
     * @return string
     */
    public function replaceTitle(string $title): string
    {
        $helper = new Helpers();
        if ($helper->isInpsydeUrl()) {
            $title = __('Inpsyde User', 'inpsydeUsers');
            $title = apply_filters('inpsyde_custom_title', $title);
        }

        return $title;
    }

    /**
     * Display users table if the page is Inpsyde custom URL.
     */
    public function createArbitraryUrl()
    {
        $helper = new Helpers();
        if ($helper->isInpsydeUrl()) {
            $front = new Front();
            $front->renderUsersTable();
        }
    }
}
