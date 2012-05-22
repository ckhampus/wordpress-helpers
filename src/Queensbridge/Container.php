<?php

namespace Queensbridge;

class Container extends \Pimple
{
    public function __construct()
    {
        $this['forms'] = array();
    }
}