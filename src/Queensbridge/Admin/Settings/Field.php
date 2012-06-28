<?php

namespace Queensbridge\Admin\Settings;

use Queensbridge\Admin\Page;
use Queensbridge\Admin\Settings\Section;

class Field
{
    protected $name;

    protected $label;

    protected $page;

    protected $section;

    protected $type;

    /**
     * Create a settings field.
     *
     * @param string $name  String for use in the 'name' attribute of tags.
     * @param string $label Label of the field.
     */
    public function __construct($name, $label, $type = 'text', array $options = array())
    {
        $this->name = $name;

        $this->label = $label;

        $this->type = $type;
    }

    /**
     * Get the field name.
     *
     * @return string The field name.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the field name.
     *
     * @param string $name The field name.
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the field label.
     *
     * @return string The field label.
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set the field label.
     *
     * @param string $label The field label.
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    public function setOption($key, $value)
    {
        $this->options[$key] = $value;
    }

    /**
     * Get the menu page.
     *
     * @return Page The menu page.
     */
    public function getPage()
    {
        return $this->section->getPage();
    }

    /**
     * Get the settings section.
     *
     * @return Section The settings section.
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * The section of the settings page in which to show the box.
     *
     * @param Section $section The section.
     */
    public function setSection(Section $section)
    {
        $this->section = $section;
    }
}
