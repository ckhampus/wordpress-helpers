<?php

namespace Queensbridge\Admin\Settings;

use Queensbridge\Admin\Page;
use Queensbridge\Admin\Settings\Field;

class Section
{
    protected $id;

    protected $title;

    protected $fields;

    protected $page;

    public function __construct($id, $title)
    {
        $this->id = $id;

        $this->title = $title;

        $this->fields = array();

        $this->page = null;
    }

    /**
     * Get the section id.
     *
     * @return string The section id.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the section id.
     *
     * @param string $id The section id.
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the section title.
     *
     * @return string The section title.
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the section title.
     *
     * @param string $title The section title.
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get the settings field.
     *
     * @return array The settings field.
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Add multiple fields to section.
     *
     * @param array $fields Array of fields.
     */
    public function addFields(array $fields = array())
    {
        foreach ($fields as $field) {
            $this->addField($field);
        }
    }

    /**
     * Add field to section.
     *
     * @param Field $field The settings field.
     */
    public function addField(Field $field)
    {
        if ($field->getSection() !== $this) {
            $field->setSection($this);
        }

        $this->fields[$field->getId()] = $field;
    }

    /**
     * Get the menu page.
     *
     * @return Page The menu page.
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set the menu page.
     *
     * @param Page $page The menu page.
     */
    public function setPage(Page $page)
    {
        $this->page = $page;
    }

    public function render()
    {

    }
}
