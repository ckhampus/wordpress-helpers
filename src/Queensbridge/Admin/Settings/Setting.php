<?php

namespace Queensbridge\Admin\Settings;

class Setting
{
    protected $title;

    public function __construct($title)
    {
        $this->title = $title;
    }

    public function render()
    {

    }
}
