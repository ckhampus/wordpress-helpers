<?php

namespace Queensbridge\Admin;

/**
* 
*/
class Menu
{
    private $menuTitle;

    private $mainPage;

    private $subPages;

    /**
     * Creates a new admin menu. The specified page
     * defines the top-level menu page. This can either
     * be a custom page or built-in WordPress menu page.
     *
     * @param Page $page A menu page.
     */
    public function __construct($title, Page $page)
    {
        $this->menuTitle = $title;
        $this->mainPage = $page;
        $this->subPages = array();
    }

    public function add(Page $page, $handle, $position = null)
    {
        if ($position === null) {
          $this->subPages[] = $page;
        } else {
          $this->subPages[$position] = $page;
        }
    }

    /**
     * Set the menu title.
     * 
     * @param string $value The menu title.
     * 
     * @return Page Returns this page instance.
     */
    public function setTitle($value)
    {
        $this->menuTitle = $value;

        return $this;
    }

    /**
     * Get the menu title.
     * 
     * @return string The menu title.
     */
    public function getTitle()
    {
        return $this->menuTitle;
    }
}