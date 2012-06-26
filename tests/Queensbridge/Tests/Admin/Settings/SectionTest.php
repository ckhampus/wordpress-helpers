<?php

namespace Queensbridge\Tests\Admin\Settings;

use Queensbridge\Admin\Settings\Section;
use Queensbridge\Admin\Settings\Field;

class SectionTest extends \PHPUnit_Framework_TestCase
{
    public function testCreatingSection()
    {
        $section = new Section('general_section', 'General settings section');
        $this->assertEquals('general_section', $section->getId());
        $this->assertEquals('General settings section', $section->getTitle());
    }

    public function testSettingValues()
    {
        $section = new Section('general_section', 'General settings section');
        $section->setId('secondary_section');
        $section->setTitle('Secondary settings section');

        $this->assertEquals('secondary_section', $section->getId());
        $this->assertEquals('Secondary settings section', $section->getTitle());
    }

    public function testAddingFields()
    {
        $section = new Section('general_section', 'General settings section');
        $field = new Field('show_footer', 'Show footer');

        $section->addField($field);

        $this->assertCount(1, $section->getFields());
    }

    public function testAddingMultipleFields()
    {
        $section = new Section('general_section', 'General settings section');
        $field1 = new Field('show_header', 'Show header');
        $field2 = new Field('show_footer', 'Show footer');

        $section->addFields(array($field1, $field2));

        $this->assertCount(2, $section->getFields());
    }
}
