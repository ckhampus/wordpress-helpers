<?php

namespace Queensbridge\Admin;

use Queensbridge\Admin\Page;
use Queensbridge\Admin\Settings\Field;
use Queensbridge\Admin\Settings\Section;

class SettingsPage extends Page
{
    protected $sections;

    public function __construct($title, $slug = null)
    {
        parent::__construct($title, $slug);

        $this->sections = array();
    }

    public function addSections(array $sections)
    {
        foreach ($sections as $section) {
            $this->addSection($section);
        }
    }

    public function addSection(Section $section)
    {
        if ($section->getPage() !== $this) {
            $section->setPage($this);
        }

        $this->sections[$section->getId()] = $section;
    }

    public function getSections()
    {
        return $this->sections;
    }

    public function render()
    {
        $app = $this->getWordpress();

        echo $app->render('settings_page.html.twig', array(
            'page' => $this
        ));
    }

    public static function createFromArray(array $options)
    {
        /*
         * array(
         *     'title' => 'Page title',
         *     'slug' => 'page-title',
         *     'sections' => array(
         *         array(
         *             'id' => 'section_name',
         *             'title' => 'Section title',
         *             'fields' => array(
         *                 array(
         *                     'name' => 'field_name',
         *                     'label' => 'Field name',
         *                     'type' => 'text'
         *                 ),
         *                 array(
         *                     'name' => 'field_name',
         *                     'label' => 'Field name',
         *                     'type' => 'text'
         *                 ),
         *                 array(
         *                     'name' => 'field_name',
         *                     'label' => 'Field name',
         *                     'type' => 'text'
         *                 )
         *             )
         *         )
         *     )
         * );
         */

        $page = new SettingsPage($options['title'], $options['slug']);

        foreach ($options['sections'] as $sectionOptions) {
            $section = new Section($sectionOptions['id'], $sectionOptions['title']);

            foreach ($sectionOptions['fields'] as $fieldOptions) {
                $field = new Field($fieldOptions['name'], $fieldOptions['label'], $fieldOptions['type']);
                $section->addField($field);
            }

            $page->addSection($section);
        }

        return $page;
    }
}
