<?php

namespace Queensbridge;

use Queensbridge\Application;
use Queensbridge\Admin\Page;
use Queensbridge\Admin\SettingsPage;

class Wordpress extends Application
{
    protected function registerPage(Page $page)
    {
        $app = $this;

        add_action('admin_init', function () use ($app, $page) {
            $page->register($app);

            if ($page instanceof SettingsPage) {
                if (false === get_option($page->getSlug())) {
                    add_option($page->getSlug());
                }

                $data = get_option($page->getSlug());

                $builder = $app['form.factory']->createNamedBuilder($page->getSlug(), 'form', $data, array(
                    'csrf_protection' => false
                ));

                // Build form
                foreach ($page->getSections() as $key => $section) {
                    foreach ($section->getFields() as $key => $field) {
                        $builder->add($field->getId(), $field->getType(), array(
                            'error_bubbling' => false
                        ));
                    }
                }

                $form = $builder->getForm();

                // Add errors to form if they exist.
                foreach ($form->getChildren() as $key => $value) {
                    $error = get_settings_errors($key);

                    if ($error) {
                        $formError = unserialize($error[0]['message']);
                        $value->addError($formError);
                    }

                }

                // Build settings screen
                foreach ($page->getSections() as $key => $section) {
                    add_settings_section($section->getId(), $section->getTitle(), function () use ($section, $form) {
                        $section->render();
                    }, $page->getSlug());

                    foreach ($section->getFields() as $key => $field) {
                        add_settings_field($field->getId(), $field->getTitle(), function () use ($field, $app, $form) {
                            echo $app->render('field.html.twig', array(
                                'form' => $form->createView(),
                                'field' => $field->getId()
                            ));
                        }, $page->getSlug(), $section->getId());
                    }
                }

                register_setting(
                    $page->getSlug(),
                    $page->getSlug(),
                    function ($input) use ($form, $app, $page) {
                        $form->bind($input);

                        $output = array();

                        foreach ($form->getChildren() as $key => $value) {
                            if ($value->isValid()) {
                                $output[$key] = $value->getData();
                            } else {
                                foreach ($value->getErrors() as $error) {
                                    add_settings_error($key, $key, serialize($error), $type = 'error');
                                }
                            }
                        }

                        return $output;
                    }
                );
            }
        });
    }

    /**
     * Add a top level menu page.
     *
     * @param Page    $page     The menu page.
     * @param integer $position The position in the menu order this menu should appear.
     */
    public function addMenuPage(Page $page, $position = null)
    {
        add_action('admin_menu', function () use ($page, $position, $result) {
            add_menu_page($page->getTitle(), $page->getMenuTitle(), 'manage_options', $page->getSlug(), array($page, 'render'), null, $position);
        });

        $this->registerPage($page);
    }

    /**
     * Add a sub menu page.
     *
     * @param string $parentSlug The slug name for the parent menu (or the file name of a standard WordPress admin page).
     * @param Page   $page       The menu page.
     */
    public function addSubmenuPage($parentSlug, Page $page)
    {
        add_action('admin_menu', function () use ($page, $parentSlug) {
            add_submenu_page($parentSlug, $page->getTitle(), $page->getMenuTitle(), 'manage_options', $page->getSlug(), array($page, 'render'));
        });

        $this->registerPage($page);
    }

    /**
     * Add sub menu page to the Dashboard menu.
     *
     * @param Page $page The menu page.
     */
    public function addDashboardPage(Page $page)
    {
        return $this->addSubmenuPage(Page::DASHBOARD, $page);
    }

    /**
     * Add sub menu page to the Posts menu.
     *
     * @param Page $page The menu page.
     */
    public function addPostsPage(Page $page)
    {
        return $this->addSubmenuPage(Page::POSTS, $page);
    }

    /**
     * Add sub menu page to the Media menu.
     *
     * @param Page $page The menu page.
     */
    public function addMediaPage(Page $page)
    {
        return $this->addSubmenuPage(Page::MEDIA, $page);
    }

    /**
     * Add sub menu page to the Links menu.
     *
     * @param Page $page The menu page.
     */
    public function addLinksPage(Page $page)
    {
        return $this->addSubmenuPage(Page::LINKS, $page);
    }

    /**
     * Add sub menu page to the Pages menu.
     *
     * @param Page $page The menu page.
     */
    public function addPagesPage(Page $page)
    {
        return $this->addSubmenuPage(Page::PAGES, $page);
    }

    /**
     * Add sub menu page to the Comments menu.
     *
     * @param Page $page The menu page.
     */
    public function addCommentsPage(Page $page)
    {
        return $this->addSubmenuPage(Page::COMMENTS, $page);
    }

    /**
     * Add sub menu page to the Appearance menu.
     *
     * @param Page $page The menu page.
     */
    public function addThemePage(Page $page)
    {
        return $this->addSubmenuPage(Page::APPEARANCE, $page);
    }

    /**
     * Add sub menu page to the Plugins menu.
     *
     * @param Page $page The menu page.
     */
    public function addPluginsPage(Page $page)
    {
        return $this->addSubmenuPage(Page::PLUGINS, $page);
    }

    /**
     * Add sub menu page to the Users menu.
     *
     * @param Page $page The menu page.
     */
    public function addUsersPage(Page $page)
    {
        return $this->addSubmenuPage(Page::USERS, $page);
    }

    /**
     * Add sub menu page to the Tools menu.
     *
     * @param Page $page The menu page.
     */
    public function addManagementPage(Page $page)
    {
        return $this->addSubmenuPage(Page::TOOLS, $page);
    }

    /**
     * Add sub menu page to the Settings menu.
     *
     * @param Page $page The menu page.
     */
    public function addOptionsPage(Page $page)
    {
        return $this->addSubmenuPage(Page::SETTINGS, $page);
    }

    public function render($name, array $context = array())
    {
        return $this['twig']->render($name, $context);
    }
}
