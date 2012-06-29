<?php

namespace Queensbridge\Tests;

use Queensbridge\WebTestCase;
use Queensbridge\Wordpress;

class WordpressTest extends WebTestCase
{
    public function testAddingMenuPage()
    {
        /*
        $page = $this->getMockBuilder('Queensbridge\\Admin\\SettingsPage')
                     ->disableOriginalConstructor()
                     ->getMock();

        $page->expects($this->atLeastOnce())
             ->method('getSlug')
             ->will($this->returnValue('foo_settings'));

        $wp = new Wordpress();
        $wp->addMenuPage($page);
         */

        $this->goToUrl('http://example.org/wp-admin/index.php');

        $page = $this->getMockBuilder('Queensbridge\\Admin\\SettingsPage')
                     ->disableOriginalConstructor()
                     ->getMock();

        $page->expects($this->atLeastOnce())
             ->method('getSlug')
             ->will($this->returnValue('foo_settings'));

        $wp = new Wordpress();
        $wp->addMenuPage($page);
    }
}