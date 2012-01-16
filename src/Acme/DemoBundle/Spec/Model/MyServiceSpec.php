<?php

namespace Acme\DemoBundle\Spec\Model;

use Symfony\Bundle\FrameworkBundle\Spec\WebSpec;
use Acme\DemoBundle\Model\MyService;
use Twig_LoaderInterface as ClassA;

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
        $twigEnvironmentMock = $this->container->mockInheriting('twig','Twig_Environment');
        $test = $this->mock('ClassA','name1');
        var_dump($test);
        die(get_class($test));
        die(get_class($this->container->get('twig')));
        //$twigEnvironmentMock->
        $this->serviceUnderSpec->methodUsingRouter()->should->be('http://specsf2.local/app_dev.php');
    }
}