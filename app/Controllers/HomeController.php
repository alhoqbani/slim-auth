<?php

namespace App\Controllers;

use App\Mail\Welcome;
use App\Models\User;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class HomeController extends BaseController
{
    
    public function index(Request $request, Response $response, $args)
    {
        $user = User::first();
//        $this->mail->send('emails/welcome.twig', ['user' => $user], function ($message) use ($user) {
//            $message->to($user->email, $user->name)
//                ->subject('Welcome to slim-auth');
//        });

        $this->mail->to($user->email, $user->name)->send(new Welcome($user));
        
//        $this->mail->send('emails/welcome.twig', ['user' => $user], function ($message) use ($user) {
//            $message->to($user->email)
//                ->attach(__DIR__ . '/../../composer.json')
//                ->subject('Composer File');
//        });
        
        return $this->view->render($response, 'home/index.twig');
    }
    
}