<?php

namespace Queensbridge\Admin;

use Queensbridge\Admin\Page;
use Queensbridge\Admin\Settings\Section;

class SettingsPage extends Page
{
    protected $sections;

    public function __construct($title, $slug = null)
    {
        parent::__construct($title, $slug);

        $this->sections = array();
    }

    public function addSection(Section $section)
    {
        $this->sections[$section->getId()] = $section;
    }
}
