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
        $filesystem->mkdir('folder1');
        return $filesystem->mkdir('folder1');
    }
}