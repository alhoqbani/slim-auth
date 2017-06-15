<?php

namespace App\Mail\Mailer;


class MessageBuilder
{
    
    /**
     * @var \Swift_Message
     */
    protected $swiftMessage;
    
    /**
     * MessageBuilder constructor.
     *
     * @param \Swift_Message $swifMessage
     *
     * @internal param \Swift_Message $swift_message
     */
    public function __construct(\Swift_Message $swifMessage)
    {
        $this->swiftMessage = $swifMessage;
    }
    
    public function from($address, $name = null)
    {
        $this->swiftMessage->setFrom($address, $name);
        
        return $this;
    }
    
    public function to($address, $name = null)
    {
        $this->swiftMessage->setTo($address, $name);
        
        return $this;
    }
    
    public function subject($subject)
    {
        $this->swiftMessage->setSubject($subject);
        
        return $this;
    }
    
    public function setBody($body)
    {
        $this->swiftMessage->setBody($body, 'text/html');
        
        return $this;
    }
    
    /**
     * @return \Swift_Message
     */
    public function getSwiftMessage(): \Swift_Message
    {
        return $this->swiftMessage;
    }
    
    public function attach($file)
    {
        $this->swiftMessage->attach(\Swift_Attachment::fromPath($file));
        return $this;
    }
    
    
}