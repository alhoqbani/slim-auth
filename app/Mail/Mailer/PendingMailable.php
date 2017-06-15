<?php

namespace App\Mail\Mailer;


class PendingMailable
{
    
    /**
     * @var \App\Mail\Mailer\Mailer
     */
    protected $mailer;
    protected $to;
    
    /**
     * PendingMailable constructor.
     *
     * @param \App\Mail\Mailer\Mailer $mailer
     *
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
    
    public function to($address, $name = null)
    {
        $this->to = compact('address', 'name');
        
        return $this;
    }
    
    public function send(Mailable $mailable)
    {
        $mailable->to($this->to['address'], $this->to['name']);
        return $this->mailer->send($mailable);
    }
}