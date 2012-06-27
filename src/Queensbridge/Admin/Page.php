<?php

namespace Queensbridge\Admin;

use Queensbridge\Inflector;

/**
 * Class that represents an admin page.
 */
class Page
{
    protected $title;

    protected $menuTitle;

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

        $this->menuTitle = null;

        $this->slug = $slug === null ? Inflector::underscore($title) : $slug;
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
     * Get the menu title. Defaults to page title.
     *
     * @return string The menu title.
     */
    public function getMenuTitle()
    {
        if ($this->menuTitle === null) {
            return $this->title;
        }

        return $this->menuTitle;
    }

    /**
     * Set the menu title.
     *
     * @param string $menuTitle The menu title.
     */
    public function setMenuTitle($menuTitle)
    {
        $this->menuTitle = $menuTitle;
    }

    /**
     * Get the page slug.
     *
     * @return string The page slug.
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the page slug.
     *
     * @param string $slug The page slug.
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {

    }
}
