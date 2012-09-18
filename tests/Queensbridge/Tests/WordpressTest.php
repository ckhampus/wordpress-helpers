<?php

namespace Queensbridge\Tests;

use Queensbridge\Wordpress;
use Queensbridge\IntegrationTestCase;

class WordpressTest extends IntegrationTestCase
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


        $page = $this->getMockBuilder('Queensbridge\\Admin\\SettingsPage')
                     ->disableOriginalConstructor()
                     ->getMock();

        $page->expects($this->atLeastOnce())
             ->method('getSlug')
             ->will($this->returnValue('foo_settings'));

        $page->expects($this->atLeastOnce())
             ->method('getSections')
             ->will($this->returnValue(array()));

        $wp = new Wordpress();
        $wp->addMenuPage($page);

        $this->go_to(admin_url());
    }
}