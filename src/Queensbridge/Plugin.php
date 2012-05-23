<?php

namespace Queensbridge;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

abstract class Plugin extends \Pimple implements EventSubscriberInterface
{
    private $data;

    const ACTIVATE    = 'plugin.activate';
    const UPDATE      = 'plugin.update';
    const DEACTIVATE  = 'plugin.deactivate';
    const UNINSTALL   = 'plugin.uninstall';

    public function __construct($file, $version = null)
    {
        $this->data = get_plugin_data($file, false);


        $app = $this;

        $this['dispatcher'] = $this->share(function () use ($app) {
            $dispatcher = new EventDispatcher();
            $dispatcher->addSubscriber($app);

            return $dispatcher;
        });

        register_activation_hook($file, function () use ($app) {
            $app['dispatcher']->dispatch(Plugin::ACTIVATE);
        });

        register_deactivation_hook($file, function () use ($app) {
            $app['dispatcher']->dispatch(Plugin::DEACTIVATE);
        });

        register_uninstall_hook($file, function () use ($app) {
            $app['dispatcher']->dispatch(Plugin::UNINSTALL);
        });
    }

    abstract public function onPluginActivate();

    abstract public function onPluginUpdate();

    abstract public function onPluginDeactivate();

    abstract public function onPluginUninstall();

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            Plugin::ACTIVATE   => 'onPluginActivate',
            Plugin::UPDATE     => 'onPluginUpdate',
            Plugin::DEACTIVATE => 'onPluginDeactivate',
            Plugin::UNINSTALL  => 'onPluginUninstall'
        );
    }
}
