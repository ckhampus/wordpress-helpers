<?php

namespace Queensbridge;

use Symfony\Component\Form\Extension\Csrf\CsrfProvider\DefaultCsrfProvider;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\SessionCsrfProvider;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\Extension\Core\CoreExtension;
//use Symfony\Component\Form\Extension\Validator\ValidatorExtension as FormValidatorExtension;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class Form
{
    /*
    private $factory;

    private $name;

    private $form;

    public function __construct($name)
    {
        $extensions = array(
            new CoreExtension(),
            new CsrfExtension(new DefaultCsrfProvider(md5(__DIR__))),
        );

        $this->name = $name;

        $this->factory = new FormFactory($extensions);
    }

    public function create(array $options)
    {
        $builder = $this->factory->createBuilder($this->name);

        if (isset($options['fields'])) {
            foreach ($options['fields'] as $field) {
                $builder->add($field['name'], $field['type']);
            }
        }

        $this->form = $builder->getForm();
    }

    public function handle(Request $request)
    {
        $form = $this->form;

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                do_action('form_submit_'.$name, $form->getData());
            }
        }
    }
    */
   
    public static function create($name, array $args)
    {
        $extensions = array(
            new CoreExtension(),
            new CsrfExtension(new DefaultCsrfProvider(md5(__DIR__))),
        );

        $factory = new FormFactory($extensions);

        $builder = $factory->createBuilder($name);

        if (isset($options['fields'])) {
            foreach ($options['fields'] as $field) {
                $builder->add($field['name'], $field['type']);
            }
        }

        return $builder->getForm();
    }

    public function handle(Form $form, Request $request = null)
    {
        if ($request === null) {
            $request = Request::createFromGlobals();
        }

        $name = $form->getName();

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                do_action('form_submit_'.$name, $form->getData());
            }
        }
    }

    public function render(Form $form)
    {
        
    }
}