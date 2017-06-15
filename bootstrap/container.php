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
    
    return $view;
};

$container['validator'] = function () {
    return new App\Validation\Validator();
};
