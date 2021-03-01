<?php

declare(strict_types=1);

if (!defined('INPSYDE_DIR_PATH')) {
    define('INPSYDE_DIR_PATH', plugin_dir_path(__FILE__));
}

if (!defined('INPSYDE_DIR_URL')) {
    define('INPSYDE_DIR_URL', plugin_dir_url(__FILE__));
}

if (!defined('INPSYDE_VIEW_PATH')) {
    define('INPSYDE_VIEW_PATH', plugin_dir_path(__FILE__) . 'views/');
}

if (!defined('INPSYDE_VERSION')) {
    define('INPSYDE_VERSION', '1.0.0');
}
