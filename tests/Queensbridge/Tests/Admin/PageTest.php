<?php

namespace Queensbridge\Tests\Admin;

use Queensbridge\Admin\Page;

class PageTest extends \PHPUnit_Framework_TestCase
{
    public function testCreatingPage()
    {
        $page = new Page('Settings page');
        $this->assertEquals('Settings page', $page->getTitle());
        $this->assertEquals('Settings page', $page->getMenuTitle());
        $this->assertEquals('settings_page', $page->getSlug());
    }

    public function testSettingMenuTitle()
    {
        $page = new Page('Settings page');
        $page->setMenuTitle('Settings menu');
        $this->assertEquals('Settings page', $page->getTitle());
        $this->assertEquals('Settings menu', $page->getMenuTitle());
    }
}
