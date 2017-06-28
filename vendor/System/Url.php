<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/20/17
 * Time: 9:40 AM
 */

namespace System;


class Url
{

    /**
     * Application Object
     *
     * @var \System\Application
     */
    protected $app;

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
     * Get Full path URL
     *
     * @param string path
     * @return string
     */
    public function link($path)
    {
        return $this->app->request->baseUrl() . trim($path, '/');
    }

    /**
     * Redirect to the given path
     *
     * @param string $path
     * @return void
     */
    public function redirectTo($path)
    {
        header('Location: ' . $this->link($path));

        exit;
    }
}