<?php

namespace App\Controllers;

use App\Models\User;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator as v;


class AuthController extends BaseController
{
    
    public function create(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'auth/register.twig');
    }
    
    public function store(Request $request, Response $response, $args)
    {
        $validation = $this->validator->validate($request, [
            'email'    => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
            'name'     => v::notEmpty()->alpha(),
            'password' => v::noWhitespace()->notEmpty(),
        ]);
        
        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('auth.register'));
        }
        
        $user = User::Create([
            'name'     => $request->getParam('name'),
            'email'    => $request->getParam('email'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
        ]);
        $this->auth->signIn($user);
        $this->flash->addMessage('success', 'Thank you, you\'re registered.');
        
        return $response->withRedirect($this->router->pathFor('home'));
    }
    
    public function getLogin(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'auth/login.twig');
    }
    
    public function postLogin(Request $request, Response $response, $args)
    {
        $auth = $this->auth->attempt(
            $request->getParam('email'),
            $request->getParam('password')
        );
        if ( ! $auth) {
            $this->flash->addMessage('error', 'Wrong !!');
            return $response->withRedirect($this->router->pathFor('auth.login'));
        }
        $this->flash->addMessage('info', 'Welcome back');
        return $response->withRedirect($this->router->pathFor('home'));
    }
    
    public function logout(Request $request, Response $response, $args)
    {
        $this->auth->logout();
        return $response->withRedirect($this->router->pathFor('home'));
    }
    
    
}