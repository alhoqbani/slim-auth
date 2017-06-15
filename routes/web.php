<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;

$app->get('/register', AuthController::class . ':create')->setName('auth.create');
$app->post('/register', AuthController::class . ':store')->setName('auth.store');;
$app->get('/', HomeController::class . ':index')->setName('home');