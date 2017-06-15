<?php

namespace App\Controllers;

use Interop\Container\ContainerInterface;

class BaseController
{
    
    /**
     * @var \Interop\Container\ContainerInterface
     */
    protected $c;
    
    public function __construct(ContainerInterface $container)
    {
        $this->c = $container;
    }
    
}