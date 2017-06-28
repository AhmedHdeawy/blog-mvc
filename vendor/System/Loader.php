<?php


namespace System;


class Loader
{

    /**
     * Application Object
     *
     * @var \System\Application
     */
    private $app;

    /**
     * Controllers Container
     *
     * @var array
     */
    private $controllers = [];

    /**
     * Models Container
     *
     * @var array
     */
    private $models= [];

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
     * call the given controller with the given method and pass the given arguments the the given controller Method
     *
     * @param string $controller
     * @param string $method
     * @param array $arguments
     *
     * @return mixed
     */
    public function action($controller, $method, array $arguments = [])
    {
        $object = $this->controller($controller);

        return call_user_func_array([$object, $method], $arguments);
    }

    /**
     * Call the given controller
     *
     * @param string $controller
     * @return object
     */
    public function controller($controller)
    {
        // Get Full Path
        $controller = $this->getControllerName($controller);


        // Check if the controller is exist in controllers container OR Not
        if(! $this->hasController($controller))
        {
            // If not exist, then Add it
            $this->addController($controller);
        }

        // if exist, then return it
        return $this->getController($controller);
    }

    /**
     * Determine if the given controler is exists in controllers container
     *
     * @param string $controller
     * @return bool
     */
    private function hasController($controller)
    {
        return array_key_exists($controller, $this->controllers);
    }

    /**
     * Create New object from the given controller and store it in controllers container
     *
     * @param string $controller
     * @return void
     */
    private function addController($controller)
    {
        $object = new $controller($this->app);

        $this->controllers[$controller] = $object;
    }

    /**
     * Get the controller Object
     *
     * @param string $controller
     * @return object
     */
    private function getController($controller)
    {
        // return the given controller fron controllers container
        return $this->controllers[$controller];
    }

    /**
     * Get full Class Name for the given controller
     *
     * @param string $controller
     * @return string
     */
    private function getControllerName($controller)
    {
        // The given is [ Home ]  but i wanna [App\Controllers\HomeController]
        // So i will do the following

        $controller .= 'Controller';  // HomeController

        $controller = 'App\\Controllers\\' . $controller;  // App\\Controllers\HomeController

        return str_replace('/', '\\', $controller);
    }



    /*============= Model =================*/

    /**
     * Call the given model
     *
     * @param string $model
     * @return object
     */
    public function model($model)
    {
        // Get Full Path
        $model = $this->getModelName($model);

        // Check if the model is exist in models container OR Not
        if(! $this->hasModel($model))
        {
            // If not exist, then Add it
            $this->addModel($model);
        }

        // if exist, then return it
        return $this->getModel($model);
    }

    /**
     * Determine if the given controler is exists in models container
     *
     * @param string $model
     * @return bool
     */
    private function hasModel($model)
    {
        return array_key_exists($model, $this->models);
    }

    /**
     * Create New object from the given model and store it in models container
     *
     * @param string $model
     * @return void
     */
    private function addModel($model)
    {
        $object = new $model($this->app);

        $this->models[$model] = $object;
    }

    /**
     * Get the model Object
     *
     * @param string $model
     * @return object
     */
    private function getModel($model)
    {
        // return the given model fron models container
        return $this->models[$model];
    }

    /**
     * Get full Class Name for the given model
     *
     * @param string $model
     * @return string
     */
    private function getModelName($model)
    {
        // The given is [ Home ]  but i wanna [App\Models\HomeModel]
        // So i will do the following

        $model .= 'Model';  // HomeModel

        $model = 'App\\Models\\' . $model;  // App\\Models\HomeModel

        return str_replace('/', '\\', $model);
    }














}