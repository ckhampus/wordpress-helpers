<?php

namespace Queensbridge\Admin;

/**
 * Class that represents an admin page.
 */
class Page
{
    private $pageTitle;

    private $menuTitle;

    private $content;

    /**
     * Creates a new admin page.
     * 
     * @param string $pageTitle The page title.
     * @param string $menuTitle The menu title.
     */
    public function __construct($pageTitle, $menuTitle)
    {
        $this->pageTitle = $pageTitle;
        $this->menuTitle = $menuTitle;
    }

    /**
     * Set the page title.
     * 
     * @param string $value The page title.
     * 
     * @return Page Returns this page instance.
     */
    public function setPageTitle($value)
    {
        $this->pageTitle = $value;

        return $this;
    }

    /**
     * Get the page title.
     * 
     * @return string The page title.
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * Set the menu title.
     * 
     * @param string $value The menu title.
     * 
     * @return Page Returns this page instance.
     */
    public function setMenuTitle($value)
    {
        $this->menuTitle = $value;

        return $this;
    }

    /**
     * Get the menu title.
     * 
     * @return string The menu title.
     */
    public function getMenuTitle()
    {
        return $this->menuTitle;
    }

    /**
     * Set the content.
     * 
     * @param string|callback $value The content.
     */
    public function setContent($value)
    {
        if (is_callable($value)) {
            $this->content = $value;
        } elseif (is_string($value)) {
            $this->content = function () use ($value) {
                echo $value;
            };
        }
    }
}