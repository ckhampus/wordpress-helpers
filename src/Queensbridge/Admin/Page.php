<?php

namespace Queensbridge\Admin;

/**
 * Class that represents an admin page.
 */
class Page
{
	private $page_title;

	private $menu_title;

	private $content;

	/**
	 * Creates a new admin page.
	 * 
	 * @param string $page_title The page title.
	 * @param string $menu_title The menu title.
	 */
	function __construct($page_title, $menu_title) {
		$this->page_title = $page_title;
		$this->menu_title = $menu_title;
	}

	/**
	 * Set the page title.
	 * 
	 * @param string $value The page title.
	 */
	public function setPageTitle($value)
	{
		$this->page_title = $value;
		return $this;
	}

	/**
	 * Get the page title.
	 * 
	 * @return string The page title.
	 */
	public function getPageTitle()
	{
		return $this->page_title;
	}

	/**
	 * Set the menu title.
	 * 
	 * @param string $value The menu title.
	 */
	public function setMenuTitle($value)
	{
		$this->menu_title = $value;
		return $this;
	}

	/**
	 * Get the menu title.
	 * 
	 * @return string The menu title.
	 */
	public function getMenuTitle()
	{
		return $this->menu_title;
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