<?php

namespace Queensbridge\Tests;

use Queensbridge\Application;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    public function testJsonResponse()
    {
        $app = new Application();
        $response = $app->json(array('message' => 'Hello!'));
        $this->assertEquals('{"message":"Hello!"}', $response->getContent());
    }

    public function testXmlResponse()
    {
        $app = new Application();
        $response = $app->xml(array('message' => 'Hello!'));
        $this->assertEquals("<?xml version=\"1.0\"?>\n<response><message>Hello!</message></response>\n", $response->getContent());
    }
}
