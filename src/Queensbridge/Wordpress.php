<?php

namespace Queensbridge;

use Queensbridge\Admin\Page;
use Queensbridge\Admin\SettingsPage;

class Wordpress
{
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
}
