<?php

namespace System;

use Closure;

class Application
{

    /**
     * Container
     * @var array
     */
    private $container = [];

    /**
     * Get Application Instance
     *
     * @var \System\Application
     */
    private static $instance;

    /***
     * Application constructor.
     *
     * @param \System\File $file
     */
    private function __construct(File $file)
    {
        $this->share('file', $file);
        $this->registerClasses();
        $this->loadHelpers();

    }

    /**
     * Start with Design Pattern
     * Get Application instance
     *
     * @param \System\File $file
     * @parm \System\Application
     * @return object
     */
    public function getInstance($file = null)
    {
        if(is_null(static::$instance))
        {
            static::$instance = new static($file);
        }
        return static::$instance;
    }

    /**
     *  Run The Application
     *
     * @return void
     */
    public function run()
    {
        $this->session->start();

        $this->request->prepareUrl();

        $this->file->requireFile('App/index.php');

        list($controller, $methods, $arguments) = $this->route->getProperRoute();

        $output = (string) $this->load->action($controller, $methods, $arguments);

        $this->response->setOutput($output);

        $this->response->send();

    }

    /**
     * Register CLass through spl auto load register
     *
     * @return void
     */
    public function registerClasses()
    {
        spl_autoload_register([$this, 'load']);

    }

    /**
     * Load class through autoloading
     * @return void
     */
    public function load($class)
    {

        // Check if the class exist in App Folder or Vendor Folder
        if(strpos($class, 'App') === 0)
        {
            // if in App Folder then generate Full path
            $file = $class . '.php';
        }
        else
        {
            // // if in vendor Folder then generate Full path
            $file = 'vendor/' . $class . '.php';
        }

        // get the class form Vendor Folder or Core Folders
        if($this->file->exists($file))
        {
            $this->file->requireFile($file);
        }

    }

    /**
     * Load Helpers file
     *
     *
     */
    private function loadHelpers()
    {
        $this->file->requireFile('vendor/helpers.php');
    }

    /**
     * get shared value
     *
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        // if class no exist in container
        if(! $this->isSharing($key))
        {
            // if exist in Core Classes
            if($this->isCoreAlias($key))
            {
                $this->share($key, $this->createNewObject($key));
            }else
            {
                die('<b>'. $key . '</b> Not found in application container');
            }
        }

        return $this->container[$key];
    }

    /**
     * Determine if the given key is shared through application
     *
     * @param string $key
     * @return bool
     *
     */
    public function isSharing($key)
    {
        return isset($this->container[$key]);
    }


    /*
     * Share the given key|value through file
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function share($key, $value)
    {
        if ($value instanceof Closure)
        {
            $value = call_user_func($value, $this);
        }
        $this->container[$key] = $value;
    }

    /**
     * Determine if the given key is an alias to core class
     *
     * @param string $alias
     * @return bool
     */
    public function isCoreAlias($alias)
    {
        $coreClasses = $this->coreClasses();

        return isset($coreClasses[$alias]);
    }

    /**
     *  Create new Object for the core class based on the given alias
     * @param string $alias
     * @return object
     */
    public function createNewObject($alias)
    {
        $coreClasses = $this->coreClasses();

        $object = $coreClasses[$alias];

        return new $object($this);
    }

    /**
     * Get All core Classes with its Aliases
     *
     *@return array
     */
    public function coreClasses()
    {
        return [

            'request'          =>      'System\\Http\\Request',
            'response'         =>      'System\\Http\\Response',
            'route'            =>      'System\\Route',
            'session'          =>      'System\\Session',
            'cookie'           =>      'System\\Cookie',
            'load'             =>      'System\\Loader',
            'html'             =>      'System\\Html',
            'db'               =>      'System\\Database',
            'view'             =>      'System\\View\\ViewFactory',
            'url'              =>      'System\\Url',
            'validator'        =>      'System\\Validation',
            'pagination'       =>      'System\\Pagination',
        ];
    }

    /*=========== Magic Methods ===============*/

    /**
     * Get shared value dynamically
     *
     *@param string $key
     *@return mixed
     */
    public function __get($key)
    {
        // TODO: Implement __get() method.
        return $this->get($key);
    }



}