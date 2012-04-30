<?php

namespace Queensbridge\Tests\Admin;

use Queensbridge\Admin\Page;

class PageTest extends \PHPUnit_Framework_TestCase
{
	public function testPageCreation()
	{
		$page = new Page('Page title', 'Menu title');

		$this->assertEquals('Page title', $page->getPageTitle());
		$this->assertEquals('Menu title', $page->getMenuTitle());
	}

	public function testSettingAndGettingPageTitle()
	{
		$page = new Page('Page title', 'Menu title');
		$page->setPageTitle('Another page title');

		$this->assertEquals('Another page title', $page->getPageTitle());
	}

	public function testSettingAndGettingMenuTitle()
	{
		$page = new Page('Page title', 'Menu title');
		$page->setMenuTitle('Another menu title');

		$this->assertEquals('Another menu title', $page->getMenuTitle());
	}
}