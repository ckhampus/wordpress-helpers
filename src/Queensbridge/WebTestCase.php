<?php

namespace Queensbridge;

use Symfony\Component\HttpFoundation\Request;

abstract class WebTestCase extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        
    }

    public function goToUrl($url, $method = 'GET')
    {
        $request = Request::create($url, $method);
        $request->overrideGlobals();

        if (!isset($_SERVER['PHP_SELF'])) {
            $_SERVER['PHP_SELF'] = '';
        }
    }
}