<?php

namespace Queensbridge;

use Silex\Application as BaseApplication,
    Silex\Provider\TwigServiceProvider,
    Silex\Provider\FormServiceProvider,
    Silex\Provider\MonologServiceProvider,
    Silex\Provider\TranslationServiceProvider,
    Silex\Provider\SessionServiceProvider,
    Silex\Provider\UrlGeneratorServiceProvider,
    Silex\Provider\ValidatorServiceProvider;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\RequestMatcher,
    Symfony\Component\Serializer\Serializer,
    Symfony\Component\Serializer\Encoder\JsonEncoder,
    Symfony\Component\Serializer\Encoder\XmlEncoder;

class Application extends BaseApplication
{
    private $name;

    public function __construct($name = '')
    {
        parent::__construct();

        $app = $this;

        $this->name = $name;

        $this->register(new SessionServiceProvider());

        $this->register(new UrlGeneratorServiceProvider());

        $this->register(new ValidatorServiceProvider());

        $this->register(new TranslationServiceProvider());

        $this->register(new FormServiceProvider());

        $this->register(new TwigServiceProvider(), array(
            'twig.path' => __DIR__.'/../../views',
        ));

        $this['twig']->addFunction('settings_errors', new \Twig_Function_Function('settings_errors'));
        $this['twig']->addFunction('settings_fields', new \Twig_Function_Function('settings_fields'));
        $this['twig']->addFunction('do_settings_sections', new \Twig_Function_Function('do_settings_sections'));
        $this['twig']->addFunction('submit_button', new \Twig_Function_Function('submit_button'));
    }

    /**
     * Convert some data into a JSON response.
     *
     * @param mixed $data    The response data
     * @param int   $status  The response status code
     * @param array $headers An array of response headers
     *
     * @see Symfony\Component\HttpFoundation\Response
     *
     * @return Symfony\Component\HttpFoundation\Response The response.
     */
    public function json($data = array(), $status = 200, $headers = array())
    {
        $serializer = new Serializer(array(), array('json' => new JsonEncoder()));
        $jsonData = $serializer->encode($data, 'json');

        return new Response($jsonData, $status, array_merge(array('Content-Type' => 'application/json'), $headers));
    }

    /**
     * Convert some data into a XML response.
     *
     * @param mixed  $data     The response data
     * @param int    $status   The response status code
     * @param string $rootNode The root node name
     * @param array  $headers  An array of response headers
     *
     * @see Symfony\Component\HttpFoundation\Response
     *
     * @return Symfony\Component\HttpFoundation\Response The response.
     */
    public function xml($data = array(), $status = 200, $rootNode = 'response', $headers = array())
    {
        $encoder = new XmlEncoder();
        $encoder->setRootNodeName($rootNode);
        $serializer = new Serializer(array(), array('xml' => $encoder));
        $xmlData = $serializer->encode($data, 'xml');

        return new Response($xmlData, $status, array_merge(array('Content-Type' => 'text/xml'), $headers));
    }
}
