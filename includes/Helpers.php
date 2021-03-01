<?php

declare(strict_types=1);

namespace InpsydeUsers;

class Helpers
{
    /**
     * Check if the current page slug same as our plugin slug.
     *
     * @return bool
     */
    public function isInpsydeUrl(): bool
    {
        global $wp;

        if (
            isset($wp->query_vars)
            && isset($wp->query_vars['page'])
            && $wp->query_vars['page'] === get_option('inpsydeCustomUrl')
        ) {
            return true;
        }

        return false;
    }
}
