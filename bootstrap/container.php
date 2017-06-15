<?php
$container = $app->getContainer();

$container['view'] = function ($container) {
    $viewsPath = __DIR__ . '/../resources/views';
    $cahcePath = __DIR__ . '/../storage/cache/views';
    $view = new \Slim\Views\Twig($viewsPath, [
        'cache' => false,
        //        'cache' => $cahcePath,
    ]);
    
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view->addExtension(new \App\View\CsrfExtension($container['csrf']));
    $view->getEnvironment()->addGlobal('auth', [
        'check' => $container->auth->check(),
        'user'  => $container->auth->user(),
    ]);
    $view->getEnvironment()->addGlobal('flash', $container->flash);
    
    return $view;
};

$container['validator'] = function () {
    return new App\Validation\Validator();
};

$container['csrf'] = function () {
    return new Slim\Csrf\Guard();
};
$container['auth'] = function () {
    return new App\Auth\Auth();
};
$container['flash'] = function () {
    return new Slim\Flash\Messages();
};
