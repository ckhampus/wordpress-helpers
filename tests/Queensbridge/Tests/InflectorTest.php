<?php

namespace Queensbridge\Tests;

use Queensbridge\Inflector;

class InflectorTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->singular_words = array(
            'post'          => 'posts',
            'page'          => 'pages',
            'type'          => 'types',
            'movie'         => 'movies',
            'plugin'        => 'plugins',
            'theme'         => 'themes',
            'menu'          => 'menus',
            'product'       => 'products',
            'place'         => 'places',
            'designer'      => 'designers',
            'search'        => 'searches',
            'tweet'         => 'tweets',
            'resource'      => 'resources',
            'information'   => 'information',
            'venue'         => 'venues',
            'order'         => 'orders',
            'line'          => 'lines',
            'order_line'    => 'order_lines',
            'post_type'     => 'post_types',
            'setting'       => 'settings',
            'table'         => 'tables',
            'row'           => 'rows',
            'computer'      => 'computers',
            'note'          => 'notes',
            'format'        => 'formats',
            'feed'          => 'feeds'
        );

        $this->plural_words = array_flip($this->singular_words);
    }

    public function testPluralization()
    {
        foreach ($this->singular_words as $singular => $plural) {
          $this->assertEquals($plural, Inflector::pluralize($singular));
        }
    }

    public function testPluralizeIf()
    {
        $this->assertEquals('1 movie', Inflector::pluralizeIf(1, 'movie'));
        $this->assertEquals('2 movies', Inflector::pluralizeIf(2, 'movie'));
    }

    public function testSingularization()
    {
        foreach ($this->plural_words as $plural => $singular) {
          $this->assertEquals($singular, Inflector::singularize($plural));
        }
    }

    public function testPluralizationOfAlreadyPluralWords()
    {
        foreach ($this->singular_words as $singular => $plural) {
          $this->assertEquals($plural, Inflector::pluralize($plural));
        }
    }

    public function testSingularizationOfAlreadySingulWords()
    {
        foreach ($this->plural_words as $plural => $singular) {
          $this->assertEquals($singular, Inflector::singularize($singular));
        }
    }

    public function testIsPlural()
    {
        foreach ($this->plural_words as $plural => $singular) {
          $this->assertTrue(Inflector::isPlural($plural));
        }
    }

    public function testIsSingular()
    {
        foreach ($this->singular_words as $singular => $plural) {
          $this->assertTrue(Inflector::isSingular($singular));
        }
    }

    public function testUnderscore()
    {
        $this->assertEquals('hello_world', Inflector::underscore('Hello World'));
        $this->assertEquals('ssl_error', Inflector::underscore('SSLError'));
    }

    public function testTableize()
    {
        $this->assertEquals('hello_worlds', Inflector::tableize('Hello World'));
        $this->assertEquals('ssl_errors', Inflector::tableize('SSLError'));
    }
}
