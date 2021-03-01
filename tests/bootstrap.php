<?php // phpcs:disable

declare(strict_types=1);

$vendor = dirname(__DIR__).'/vendor';

if (! realpath($vendor)) {
    die('Please install via Composer before running tests.');
}

require_once dirname(__DIR__) . 'env.php';
require_once "{$vendor}/autoload.php";
