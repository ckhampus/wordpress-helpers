<?php

namespace Queensbridge;

use Silex\Application as BaseApplication,
    Silex\Provider\MonologServiceProvider,
    Silex\Provider\UrlGeneratorServiceProvider;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\RequestMatcher,
    Symfony\Component\Serializer\Serializer,
    Symfony\Component\Serializer\Encoder\JsonEncoder,
    Symfony\Component\Serializer\Encoder\XmlEncoder;

class Application extends BaseApplication
{
    private $name;

    public function __contruct($name = '')
    {
        parent::__construct();

        $this->name = $name;

        /*
        $this->register(new MonologServiceProvider(), array(
            'monolog.name' => $name,
            'monolog.logfile' => WP_API_PLUGIN_PATH.'/development.log'
        ));
        */

        $this->register(new UrlGeneratorServiceProvider());
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