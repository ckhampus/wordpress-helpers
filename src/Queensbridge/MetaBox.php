<?php

namespace Queensbridge;

class MetaBox
{
    abstract public function setup();

    abstract public function render();

    abstract public function save($id);
}
