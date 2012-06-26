<?php

namespace Queensbridge\Admin\Settings;

use Queensbridge\Admin\Page;
use Queensbridge\Admin\Settings\Section;

class Field
{
    protected $id;

    protected $title;

    /**
     * [__construct description]
     * @param string $id    String for use in the 'id' attribute of tags.
     * @param string $title Title of the field.
     */
    public function __construct($id, $title)
    {
        $this->id = $id;

        $this->title = $title;
    }

    /**
     * The menu page on which to display this field.
     *
     * @param Page $page The menu page.
     */
    public function setPage(Page $page)
    {

    }

    /**
     * The section of the settings page in which to show the box.
     *
     * @param Section $section The section.
     */
    public function setSection(Section $section)
    {
        # code...
    }

    public function render()
    {

    }
}
