<?php

namespace App\Mail;

use App\Mail\Mailer\Mailable;
use App\Models\User;

class Welcome extends Mailable
{
    
    /**
     * @var \App\Models\User
     */
    protected $user;
    
    /**
     * Welcome constructor.
     *
     * @param \App\Models\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function build()
    {
        return $this->subject("Welcome to Slim-Auth {$this->user->name}")
            ->view('emails/welcome.twig')
            ->from('mailable@welcome.com', 'Hamoud')
            ->with([
                'user' => $this->user,
            ]);
    }
}