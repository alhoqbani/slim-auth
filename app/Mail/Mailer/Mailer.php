<?php

namespace App\Mail\Mailer;

use Slim\Views\Twig;
use Swift_Message;

class Mailer
{
    
    /**
     * @var \Swift_Mailer
     */
    protected $swift;
    /**
     * @var \Slim\Views\Twig
     */
    protected $twig;
    protected $from = [];
    
    /**
     * Mailer constructor.
     *
     * @param \Swift_Mailer    $swift
     * @param \Slim\Views\Twig $twig
     */
    public function __construct(\Swift_Mailer $swift, Twig $twig)
    {
        $this->swift = $swift;
        $this->twig = $twig;
    }
    
    public function alwaysFrom($address, $name = null)
    {
        $this->from = compact('address', 'name');
        
        return $this;
    }
    
    public function send($view, $viewData, Callable $callback = null)
    {
        $message = $this->buildMessage();
        call_user_func($callback, $message);
        $message->setBody($this->parseView($view, $viewData));
        
        return $this->swift->send($message->getSwiftMessage());
    }
    
    protected function buildMessage()
    {
        return (new MessageBuilder(new Swift_Message))
            ->from($this->from['address'], $this->from['name']);
    }
    
    protected function parseView($view, $viewData)
    {
        return $this->twig->fetch($view, $viewData);
    }
}