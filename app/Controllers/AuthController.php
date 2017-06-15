<?php

namespace App\Controllers;

use App\Models\User;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class AuthController extends BaseController
{
    
    public function create(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'auth/register.twig');
    }
    
    public function store(Request $request, Response $response, $args)
    {
        $user = User::UpdateOrCreate([
            'name'     => $request->getParam('name'),
            'email'    => $request->getParam('email'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
        ]);
        
        return $response->withRedirect($this->router->pathFor('home'));
    }
    
}