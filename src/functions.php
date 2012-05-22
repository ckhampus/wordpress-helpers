<?php

use Queensbridge\Container,
    Queensbridge\Form;

$GLOBALS['qb_forms'] = array();

if (!function_exists('register_form')) {
    /**
     * Create a new form.
     *
     * @param  string $name A unique form name.
     * @param  array  $args An array of arguments.
     */
    function register_form($name, array $args) {
        $GLOBALS['qb_forms'][$name] = Form::create($name, $args);
    }
}

if (!function_exists('render_form')) {
    /**
     * Render a form.
     *
     * @param  string $name     A unique form name.
     * @param  array  $defaults An array of with default values.
     */
    function render_form($name, array $defaults) {
        Form::handle($GLOBALS['qb_forms'][$name]);
    }
}