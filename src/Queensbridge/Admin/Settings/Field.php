<?php

namespace Queensbridge\Admin\Settings;

use Queensbridge\Admin\Page;
use Queensbridge\Admin\Settings\Section;

class Field
{
    protected $id;

    protected $title;

    protected $page;

    protected $section;

    protected $type;

    /**
     * Create a settings field.
     *
     * @param string $id    String for use in the 'id' attribute of tags.
     * @param string $title Title of the field.
     */
    public function __construct($id, $title, $type = 'text', array $options = array())
    {
        $this->id = $id;

        $this->title = $title;

        $this->type = $type;
    }

    /**
     * Get the field id.
     *
     * @return string The field id.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the field id.
     *
     * @param string $id The field id.
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the field title.
     *
     * @return string The field title.
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the field title.
     *
     * @param string $title The field title.
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
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
