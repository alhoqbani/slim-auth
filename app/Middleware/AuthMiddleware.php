<?php

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


class AuthMiddleware extends BaseMiddleware
{
    
    /**
     * Redirect if unauthenticated
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, callable $next)
    {
        if ( ! $this->auth->check()) {
            $this->flash->addMessage('error', 'Please Sign In First');
            return $response->withRedirect($this->router->pathFor('auth.login'));
        }
        
        $response = $next($request, $response);
        
        return $response;
    }
}