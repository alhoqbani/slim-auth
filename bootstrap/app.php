<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

if (file_exists((dirname(__DIR__) . '/.env'))) {
    $dotenv = new Dotenv\Dotenv(dirname(__DIR__));
    $dotenv->load();
}

$app = new Slim\App([
    'settings' => require __DIR__ . '/settings.php',
]);

require_once __DIR__ . '/container.php';
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../routes/web.php';
require_once __DIR__ . '/middleware.php';

\Respect\Validation\Validator::with('App\Validation\Rules');