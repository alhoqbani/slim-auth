<?php

use App\Middleware\OldInputMiddleware;
use App\Middleware\ValidationMiddleware;

$app->add(new ValidationMiddleware($container));
$app->add(new OldInputMiddleware($container));