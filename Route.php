<?php


namespace System;


class Route
{

    /**
     * Application Object
     * @var \System\Application
     */
    private $app;

    /**
     * Routes Container
     * @var array
     */
    private $routes = [];

    /**
     * Not Founde
     * @var string
     */
    private $notFound;
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
     * Add new route
     *
     * @param string $url
     * @param string $action
     * @param string $requestMethod
     *
     * @return void
     */
    public function add($url, $action, $requestMethod = 'GET')
    {

        // Store Every thing from URL
        $routes = [

            'url'       =>  $url,
            'pattern'   =>  $this->generatePattern($url),
            'action'    =>  $this->getAction($action),
            'method'    =>  strtoupper($requestMethod),
        ];

        // Calling Routes array and store in it
        $this->routes[] = $routes;

    }


    /**
     * Get All Routes
     *
     * @return array
     */
    public function routes()
    {
        return $this->routes;
    }

    /**
     * Set Not FOund Url
     * @param string $url
     * @return void
     */
    public function notFound($url)
    {
        $this->notFound = $url;
    }


    /**
     * Get Proper Route
     *
     * @return array
     */
    public function getProperRoute()
    {

        foreach ($this->routes as $route) {

            if($this->isMatching($route['pattern']) AND $this->isMatchingRequestMethod($route['method'])) {

                // if matching i need to Get ( Controller Name, Method Name, Arguments )
                // first step : get arguments
                $arguments = $this->getArgumentsFrom($route['pattern']);

                // second step : Action ==> controller@method
                list($controller, $methods) = explode('@', $route['action']);

                // Return array contains three elements
                return [$controller, $methods, $arguments];
            }
        }

        // If the User Type Unknown Page
        //==============
        return $this->app->url->redirectTo($this->notFound);

    }

    /**
     * Determine if the given pattern matches the current request url
     * @param string $pattern
     *
     * @return bool
     */
    private function isMatching($pattern)
    {
        return preg_match($pattern, $this->app->request->url());
    }

    /**
     *  Determine if the current request Method equal to the given route method
     *
     * @param string $routeMethod
     * @return bool
     */
    private function isMatchingRequestMethod($routeMethod)
    {
        return $routeMethod == $this->app->request->method();
    }

    /**
     * Get Arguments From the current ur  based on the given pattern
     * @param string $pattern
     * @return array
     */
    private function getArgumentsFrom($pattern)
    {
        preg_match($pattern, $this->app->request->url(), $matches);

        /* Now Matches contains 3 elements
         *  Array
                (
                    [0] => /posts/my-post-title/3456    // Full Url
                    [1] => my-post-title                // first argument (title)
                    [2] => 3456                         // second argument (id)
                )
         *
         *
         * So i wanna remove the first element and return title and ID
         */

        // Array Shift to remove the first element
        array_shift($matches);
        return $matches;
    }

    /**
     * Generate a regext for the given url
     *
     * @param string $url
     * @return string
     */
    private function generatePattern($url)
    {
        // Url will be in form like [ /blog/posts/my-title-post/id ]
        //                          [ /blog/:text/:id ]

        // Start Regex
        $pattern = '#^';

        // Replace :text with ([a-zA-Z0-9-])
        // Replace :id (\d+)

        /*
         *  str_replace() replace text with another
         * my name is ahmed
         * replace (my) with (you)
         * str_replace('my', 'you', 'my name is ahmed');
         *
         * str_replace(['my', 'ahmed'], ['you', 'hassan'], 'my name is ahmed');
         */
        $pattern .= str_replace([':text', ':id'], ['([a-zA-Z0-9-]+)', '(\d+)'], $url);

        // End Regex
        $pattern .= '$#';


        return $pattern;
    }

    /**
     * Get the Proper Action
     *
     * @param string $url
     * @return string
     */
    private function getAction($action)
    {
        $action = str_replace('/', '\\', $action);


        return strpos($action, '@') !== false ? $action : $action . '@index';
    }

}