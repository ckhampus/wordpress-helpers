<?php
$path = realpath(__DIR__.'/../../wordpress-tests/init.php');

if ( file_exists( $path ) ) {
    require_once $path;
    require_once __DIR__.'/../vendor/autoload.php';
} else {
    exit( "Couldn't find path to wordpress-tests/init.php\n" );
}
