<?php

namespace Queensbridge\Admin;

/**
 * Class that represents an admin page.
 */
class Page
{
    protected $title;

    protected $slug;

    /**
     * Creates a new admin page.
     *
     * @param string $title The page title.
     * @param string $slug  The slug name to refer to this menu by (should be unique for this menu).
     */
    public function __construct($title, $slug = null)
    {
        $this->title = $title;

        $this->slug = $slug === null ? Inflector::underscore($title) : $slug;
    }

    /**
     * Set the page title.
     *
     * @param string $value The page title.
     *
     * @return Page Returns this page instance.
     */
    public function setTitle($value)
    {
        $this->title = $value;

        return $this;
    }

    /**
     * Get the page title.
     *
     * @return string The page title.
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function render()
    {

    }
}
