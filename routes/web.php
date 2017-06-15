<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;

$app->get('/register', AuthController::class . ':create')->setName('auth.register');
$app->post('/register', AuthController::class . ':store');
$app->get('/login', AuthController::class . ':getLogin')->setName('auth.login');
$app->post('/login', AuthController::class . ':postLogin');
$app->get('/password', AuthController::class . ':getPassword')->setName('auth.password');
$app->post('/password', AuthController::class . ':postPassword');
$app->get('/logout', AuthController::class . ':logout')->setName('auth.logout');
$app->get('/', HomeController::class . ':index')->setName('home');
