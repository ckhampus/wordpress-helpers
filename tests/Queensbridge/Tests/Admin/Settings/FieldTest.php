<?php

namespace Queensbridge\Tests\Admin\Settings;

use Queensbridge\Admin\Settings\Field;

class FieldTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateField()
    {
        $field = new Field('show_footer', 'Show footer');
        $this->assertEquals('show_footer', $field->getId());
        $this->assertEquals('Show footer', $field->getTitle());
    }

    public function testSettingValues()
    {
        $field = new Field('show_footer', 'Show footer');
        $field->setId('show_header');
        $field->setTitle('Show header');

        $this->assertEquals('show_header', $field->getId());
        $this->assertEquals('Show header', $field->getTitle());
    }
}
