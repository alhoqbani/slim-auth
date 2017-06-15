<?php

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


class GuestMiddleware extends BaseMiddleware
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
        if ($this->auth->check()) {
            $this->flash->addMessage('info', 'For Unsigned users only !! ');
            
            return $response->withRedirect($this->router->pathFor('home'));
        }
        
        $response = $next($request, $response);
        
        return $response;
    }
}