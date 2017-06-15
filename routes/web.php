<?php


use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->get('/', function (Request $request, Response $response, $args) {
    return $response->write('<h1>Hello World!</h1>');
});

$app->get('/home', function (Request $request, Response $response, $args) {
    return $this->view->render($response, 'home/index.twig');
});