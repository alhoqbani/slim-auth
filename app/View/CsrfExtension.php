<?php

namespace App\View;

use Slim\Csrf\Guard;

class CsrfExtension extends \Twig_Extension
{
    
    /**
     * @var \Slim\Csrf\Guard
     */
    private $csrf;
    
    /**
     * CsrfFieldExtension constructor.
     *
     * @param \Slim\Csrf\Guard $csrf
     */
    public function __construct(Guard $csrf)
    {
        $this->csrf = $csrf;
    }
    
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('csrf_field', [$this, 'csrfField']),
            new \Twig_SimpleFunction('csrf_token', [$this, 'csrfToken']),
        ];
    }
    
    public function csrfField()
    {
        return "
            <input type='hidden' name='{$this->csrf->getTokenNameKey()}' value='{$this->csrf->getTokenName()}'>
            <input type='hidden' name='{$this->csrf->getTokenValueKey()}' value='{$this->csrf->getTokenValue()}'>
            ";
    }
    
    public function csrfToken()
    {
        return [
            'name'  => ['key' => $this->csrf->getTokenNameKey(), 'value' => $this->csrf->getTokenName()],
            'value' => ['key' => $this->csrf->getTokenValueKey(), 'value' => $this->csrf->getTokenValue()],
        ];
    }
}
