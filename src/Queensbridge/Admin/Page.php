<?php

namespace Queensbridge\Admin;

/**
 * Class that represents an admin page.
 */
class Page
{
    private $title;

    private $content;

    private $slug;

    /**
     * Creates a new admin page.
     * 
     * @param string $title The page title.
     */
    public function __construct($title, $slug)
    {
        $this->title = $title;
        $this->slug = $slug;
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