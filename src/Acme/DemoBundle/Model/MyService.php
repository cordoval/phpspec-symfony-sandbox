<?php

namespace Acme\DemoBundle\Model;

class MyService
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function methodUsingFileSystem()
    {
        $filesystem = $this->container->get('filesystem');
        return $filesystem->mkdir('folder1');
    }

    public function methodUsingRouter()
    {
        $router = $this->container->get('router');
        return $router->generate('_welcome');
    }
}