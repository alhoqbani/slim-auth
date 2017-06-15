<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\UsersController;

$app->group('/users', function () {
    $this->get('', UsersController::class . ':index')->setName('users.index');
    $this->post('', UsersController::class . ':store')->setName('users.store');
    $this->get('/create', UsersController::class . ':create')->setName('users.create');
    $this->get('/{id}', UsersController::class . ':show')->setName('users.show');
    $this->delete('/{id}', UsersController::class . ':destroy')->setName('users.delete');
});
$app->group('', function () {
    $this->get('/register', AuthController::class . ':create')->setName('auth.register');
    $this->post('/register', AuthController::class . ':store');
    $this->get('/login', AuthController::class . ':getLogin')->setName('auth.login');
    $this->post('/login', AuthController::class . ':postLogin');
    $this->post('/forget', AuthController::class . ':forget');
})->add(new \App\Middleware\GuestMiddleware($container));

$app->group('', function () {
    $this->get('/', HomeController::class . ':index')->setName('home');
    $this->get('/logout', AuthController::class . ':logout')->setName('auth.logout');
    $this->get('/password', AuthController::class . ':getPassword')->setName('auth.password');
    $this->post('/password', AuthController::class . ':postPassword');
})->add(new \App\Middleware\AuthMiddleware($container));
