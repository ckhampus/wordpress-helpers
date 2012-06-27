<?php

namespace Queensbridge;

use Queensbridge\Admin\Page;
use Queensbridge\Admin\SettingsPage;

class Wordpress
{
    private static $instance;

    public function __construct()
    {

    }

    public static function singleton()
    {
        if (!isset(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className;
        }

        return self::$instance;
    }

    public static function addMenuPage(Page $page)
    {
        if ($page instanceof SettingsPage) {
            var_dump($page);

            \add_plugins_page( $page->getTitle(), $page->getMenuTitle(), 'manage_options', $page->getSlug(), array($page, 'render'));

            foreach ($page->getSections() as $key => $section) {
                \add_settings_section($section->getID(), $section->getTitle(), array($section, 'render'), $page->getSlug());

                foreach ($section->getFields() as $key => $field) {
                    \add_settings_field($field->getID(), $field->getTitle(), array($field, 'render'), $page->getSlug(), $section->getID());
                }
            }
        }
    }

    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup()
    {
        trigger_error('Unserializing is not allowed.', E_USER_ERROR);
    }
}
