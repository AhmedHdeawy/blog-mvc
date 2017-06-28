<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/05/17
 * Time: 11:34 ص
 */

namespace System\Http;

use System\Application;

class Response
{

    /**
     * Application Object
     *
     * @var \System\Application $app
     */
    private $app;

    /**
     * Headers container that will be sent to the browser
     *
     * @var array
     */
    private $headers = [];

    /**
     * The content that will be sent to the browser
     *
     * @var string
     */
    private $content = '';

    /**
     * Constructor
     *
     * @param \System\Application $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * set The response Output Content
     *
     * @param string $content
     * @return void
     */
    public function setOutput($content)
    {
        $this->content = $content;
    }

    /**
     * Set the response Header
     *
     * @param string $header
     * $param mixed $value
     * @return void
     */
    public function setHeader($header, $value)
    {
        $this->headers[$header] = $value;
    }

    /**
     * send the reponse header and conent
     *
     * @return void
     */
    public function send()
    {
        $this->sendHeader();

        $this->sendOutput();
    }

    /**
     * send the reponse header
     *
     * @return void
     */
    public function sendHeader()
    {
        foreach ($this->headers as $header => $value) {
            header($header. ':' . $value);
        }
    }

    /**
     * send the reponse output
     *
     * @return void
     */
    public function sendOutput()
    {
        echo $this->content;
    }
















}