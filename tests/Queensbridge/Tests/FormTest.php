<?php

namespace Queensbridge\Tests;

use Queensbridge\Form;

class FormTest extends \PHPUnit_Framework_TestCase
{
    public function testForm()
    {
        $form = new Form('test');
        $form->create(array(
            array(
                'name' => 'first_name',
                'type' => 'text'
            ),
            array(
                'name' => 'last_name',
                'type' => 'text'
            ),
            array(
                'name' => 'email',
                'type' => 'email'
            )
        ));

        $form->render(function ($data) {
            
        });
    }
}