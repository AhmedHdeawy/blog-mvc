<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/05/17
 * Time: 10:01 ص
 */

namespace System\View;

use System\Application;


class ViewFactory
{

    /*
     * Application Object
     * @var \System\Application
     */
    private $app;

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
     * Render the given view path with the passed variables and generate new View Object
     *
     * @param $viewPath
     * @param array $data
     * @return \System\View\ViewInterface
     */

    public function render($viewPath, array $data = [])
    {
        // new view from View Class [ constructor ]
        return new View($this->app->file, $viewPath, $data);
    }

}