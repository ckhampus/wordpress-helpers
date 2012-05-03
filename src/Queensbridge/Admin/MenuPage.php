<?php

namespace Queensbridge\Admin;

/*

class SearchMenuPage extends MenuPage
{
    public function __construct()
    {
        $this->setPageTitle('Search');
        $this->setMenuTitle('Search');
        $this->setmenuSlug('search');
        $this->setCapabilities(array('administrator'));
    }

    public function render()
    {
        
    }
}

*/

/**
 * The base class for creating a menu page.
 */
class MenuPage
{
    private $pageTitle;

    private $pageContent;

    private $menuTitle;

    private $menuSlug;

    private $capability;

    public function __construct()
    {

    }

    /**
     * Set the title of the page. This text
     * will be displayed in the title tags 
     * of the page when the menu is selected.
     *
     * @param string $value The page title.
     */
    public function setPageTitle($value)
    {
        $this->pageTitle = $value;

        if ($this->menuTitle === null) {
            $this->menuTitle = $value;
        }
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
     * The callback that displays the
     * page content for the menu page.
     *
     * @param callback $value The page content callback.
     */
    public function setPageContent($value)
    {
        if (is_callable($value)) {
            $this->pageContent = $value;
        } elseif (is_string($value)) {
            $this->pageContent = function () use ($value) {
                echo $value;
            };
        }
    }

    /**
     * Get the page content.
     * 
     * @return callback The page content callback.
     */
    public function getPageContent()
    {
        return $this->pageContent;
    }

    /**
     * Set the menu title. This is the 
     * on-screen name text for the menu.
     * 
     * @param string $value The menu title.
     */
    public function setMenuTitle($value)
    {
        $this->menuTitle = $value;
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
     * Set the menu slug. The slug name to refer to
     * this menu by (should be unique for this menu).
     * 
     * @param string $value The menu slug.
     */
    public function setMenuSlug($value)
    {
        $this->menuSlug = $value;
    }

    /**
     * Get the menu slug.
     *
     * @return string The menu slug.
     */
    public function getMenuSlug()
    {
        return $this->menuSlug;
    }

    /**
     * Set the capability required for this
     * menu to be displayed to the user.
     *
     * @param string $value The capability.
     */
    public function setCapability($value)
    {
        $this->capability = $value;
    }

    /**
     * Get the capability.
     *
     * @return string The capability.
     */
    public function getCapability()
    {
        return $this->capability;
    }

    public function render()
    {
        
    }
}