<?php

namespace Queensbridge\Tests\Admin;

use Queensbridge\Admin\SettingsPage;
use Queensbridge\Admin\Settings\Section;
use Queensbridge\Admin\Settings\Field;

class SettingsPageTest extends \PHPUnit_Framework_TestCase
{
    public function testAddingSections()
    {
        $page = new SettingsPage('Settings page');
        $section = new Section('general_section', 'General settings section');
        $field1 = new Field('show_header', 'Show header');
        $field2 = new Field('show_footer', 'Show footer');

        $section->addFields(array($field1, $field2));

        $page->addSection($section);

        $this->assertCount(1, $page->getSections());
        $this->assertEquals($page, $field1->getPage());
    }
}
