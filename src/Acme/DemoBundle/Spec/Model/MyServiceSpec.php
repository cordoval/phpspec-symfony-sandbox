<?php

namespace Acme\DemoBundle\Spec\Model;

use Symfony\Bundle\FrameworkBundle\Spec\WebSpec;
use Acme\DemoBundle\Model\MyService;
use Twig_Environment;

class DescribeMyService extends WebSpec
{
    protected $container;
    protected $client;
    protected $serviceUnderSpec;

    public function before()
    {
        $this->client = self::createClient();
        $this->container = $this->client->getContainer();
        $this->serviceUnderSpec = $this->spec(new MyService($this->container));
    }

    /**
     * 1st approach is specking MyService class mocking another service
     */
    public function itShouldGetCreateDirectoryUsingFileSystemServiceFromContainer()
    {
        $filesystemMock = $this->container->mock('filesystem', 'Symfony\Component\Filesystem\Filesystem');
        $filesystemMock->shouldReceive('mkdir')->once()->andReturn(true);

        $this->serviceUnderSpec->methodUsingFileSystem()->should->beTrue();
    }

    /**
     * 2nd more functional approach to speck MyService with real services
     */
    public function itShouldRunCommandOnClient()
    {
        $twigEnvironmentMock = $this->container->mock('twig','\Twig_Environment');
        $this->serviceUnderSpec->methodUsingRouter()->should->be('/');
        //$crawler = $this->client->request('GET', '/');
        //$this->serviceUnderSpec->checkInternalResponse()->should->be('PSSMockeryBundle  + PHPSpec rock!');
    }
}