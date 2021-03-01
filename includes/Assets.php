<?php

declare(strict_types=1);

namespace InpsydeUsers;

class Assets
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueueStyles']);
        add_action('admin_enqueue_scripts', [$this, 'adminEnqueueStyles']);
    }

    /**
     * Enqueue css file for table
     */
    public function enqueueStyles()
    {
        wp_enqueue_style(
            'inpsyde-users-style',
            INPSYDE_DIR_URL . 'assets/dist/style.css',
            null,
            INPSYDE_VERSION
        );

        wp_enqueue_script(
            'inpsyde-users-script',
            INPSYDE_DIR_URL . 'assets/dist/script.js',
            ['jquery'],
            INPSYDE_VERSION,
            true
        );

        $localizeVars = [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('inpsydeNonce'),
        ];
        wp_localize_script('inpsyde-users-script', 'inpsydeUsers', $localizeVars);
    }

    /**
     * Enqueue admin CSS for styles of the admin options page.
     */
    public function adminEnqueueStyles()
    {
        wp_enqueue_style(
            'inpsyde-users-admin-style',
            INPSYDE_DIR_URL . 'assets/dist/style-admin.css',
            null,
            INPSYDE_VERSION
        );
    }
}
