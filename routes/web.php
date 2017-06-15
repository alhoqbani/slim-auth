<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;

$app->get('/register', AuthController::class . ':create')->setName('auth.create');
$app->post('/register', AuthController::class . ':store')->setName('auth.store');
$app->get('/login', AuthController::class . ':getLogin')->setName('auth.login');
$app->post('/login', AuthController::class . ':postLogin');
$app->get('/', HomeController::class . ':index')->setName('home');