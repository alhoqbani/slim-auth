<?php

use App\Middleware\ValidationMiddleware;

$app->add(new ValidationMiddleware($container));