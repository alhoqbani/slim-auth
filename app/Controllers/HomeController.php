<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class HomeController extends BaseController
{
    
    public function index(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'home/index.twig');
    }
    
}