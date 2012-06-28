<?php

namespace Queensbridge\Tests\Admin\Settings;

use Queensbridge\Admin\Settings\Field;

class FieldTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateField()
    {
        $field = new Field('show_footer', 'Show footer');
        $this->assertEquals('show_footer', $field->getName());
        $this->assertEquals('Show footer', $field->getLabel());
    }

    public function testSettingValues()
    {
        $field = new Field('show_footer', 'Show footer');
        $field->setName('show_header');
        $field->setLabel('Show header');

        $this->assertEquals('show_header', $field->getName());
        $this->assertEquals('Show header', $field->getLabel());
    }
}
