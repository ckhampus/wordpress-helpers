<?php

/*
Plugin Name: WordPress Helpers
Description: Helper classes and functions for WordPress.
Version: 0.0.1
Author: Queensbridge AB
Author URI: http://queensbridge.se
*/

require __DIR__.'/vendor/autoload.php';

use Queensbridge\Application;

$app = new Application();

$app->get('/', function () use ($app) {
    $request = $app['request'];
    $script = trim(substr($request->getScriptName(), strlen($request->getBasePath())), '/');
});

$app->error(function () {
    return '';
});

//$app->run();
//die();
