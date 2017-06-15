<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => getenv('DB_CONNECTION'),
    'host'      => getenv('DB_HOST'),
    'database'  => getenv('DB_DATABASE'),
    'username'  => getenv('DB_USERNAME'),
    'password'  => getenv('DB_PASSWORD'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function () use ($capsule) {
    return new $capsule;
};

//require 'migration.php';

//$container['db'] = function () use ($capsule) {
//    $pdo = new \PDO(
//        getenv('DB_CONNECTION') . ':host=' .
//        getenv('DB_HOST') . ';dbname=' . getenv('DB_DATABASE'),
//        getenv('DB_USERNAME'),
//        getenv('DB_PASSWORD')
//    );
//    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
//
//    return $pdo;
//};