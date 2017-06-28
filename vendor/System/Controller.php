<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 14/05/17
 * Time: 11:53 ص
 */

namespace System;


abstract class Controller
{
    /**
     * Application Object
     *
     * @var \System\Application
     */
    protected $app;

    /**
     * Errors
     * @var array
     */
    protected $errors = [];

    /**
     * Constructor
     *
     * @param \System\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Call shared application object dynamically
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->app->get($key);
    }
}