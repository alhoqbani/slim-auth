<?php

namespace App\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\NotFoundException;

class UsersController extends BaseController
{
    
    public function index(Request $request, Response $response, $args)
    {
        $users = User::all();
        
        return $this->view->render($response, 'users/index.twig', compact('users'));
    }
    
    public function show(Request $request, Response $response, $args)
    {
        try {
            $user = User::where('id', $args['id'])->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException($request, $response);
        }
        
        return $this->view->render($response, 'users/show.twig', compact('user'));
    }
    
    public function destroy(Request $request, Response $response, $args)
    {
        try {
            $user = User::where('id', $args['id'])->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return $response->withJson(['error' => 'user not found'], 404);
        }
        if ($user->delete()) {
            return $response->withJson([], 204);
        }
        
        return $response->withJson(['error' => 'Something went wrong'], 400);
    }
    
}