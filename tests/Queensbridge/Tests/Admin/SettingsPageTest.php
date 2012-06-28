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
        $section1 = new Section('general_section', 'General settings section');
        $section2 = new Section('other_section', 'Other settings section');
        $field1 = new Field('show_header', 'Show header');
        $field2 = new Field('show_footer', 'Show footer');

        $section1->addFields(array($field1, $field2));

        $page->addSections(array($section1, $section2));

        $this->assertCount(2, $page->getSections());
        $this->assertEquals($page, $field1->getPage());
    }

    public function testCreatingSettingsPageFromArray()
    {
        $page = SettingsPage::createFromArray(array(
            'title' => 'Page title',
            'slug' => 'page-title',
            'sections' => array(
                array(
                    'id' => 'section_name',
                    'title' => 'Section title',
                    'fields' => array(
                        array(
                            'name' => 'field_name_one',
                            'label' => 'Field name',
                            'type' => 'text'
                        ),
                        array(
                            'name' => 'field_name_two',
                            'label' => 'Field name',
                            'type' => 'text'
                        )
                    )
                )
            )
        ));

        $sections = $page->getSections();

        $this->assertCount(1, $sections);
        $this->assertCount(2, $sections['section_name']->getFields());
    }
}
