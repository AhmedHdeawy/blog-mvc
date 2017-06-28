<?php

namespace System\Http;

class Request
{
    /**
     *  Url
     *
     * @var string
     */
    private $url;

    /**
     * Base url
     * @var string
     */
    private $baseUrl;

    /**
     * Get File Data
     *
     * @var array
     */
    private $files = [];

    /**
     * Prepare URL and set it
     * @return void
     */
    public function prepareUrl()
    {
        // $this->server('SCRIPT_NAME')  will provide [ /blog/index.php ] so i wanna remove index.php

        $script = dirname($this->server('SCRIPT_NAME'));  // dir name will get path only [ /blog ]

        // Request Uri
        $requestUri = $this->server('REQUEST_URI'); // get request like [ /blog/posts/my-tutorials-php/?id=438 ]

        /*
         * the first step => i will check if the url has ( ? ) or no
         * if exist then divide the Uri into requestUri  and Query String in separator list
         * */
        if(strpos($requestUri, '?') !== false)
        {
            // divide the Uri into [ $requestUri ] which has uri before (?) and [ $quesryString ]
            list($requestUri, $quesryString) = explode('?', $requestUri);
        }

        // the second step => remove script name [/blog] from uri  and store it in $this->url
        $this->url = rtrim(preg_replace('#^' . $script .'#', '', $requestUri), '/');

        if(! $this->url) {
            $this->url = '/';
        }

        // handling Base url
        /*
         * i can using base Url to get Image path, CSS path, JS path , ....etc
         * */

        $this->baseUrl = $this->server('REQUEST_SCHEME') . '://' . $this->server('HTTP_HOST') . $script . '/';


    }

    /**
     * get value from _GET by the given key
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        //return array_get($_GET, $key, $default);
        $value = array_get($_GET, $key, $default);

        if(is_array($value)) {
            $value = array_filter($value);
        } else {
            $value = trim($value);
        }

        return $value;
    }

    /**
     * get value from _POST by the given key
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function post($key, $default = null)
    {
        $value = array_get($_POST, $key, $default);
        if(is_array($value)) {
            $value = array_filter($value);
        } else {
            $value = trim($value);
        }

        return $value;
    }

    /**
     * Get Uploaded File Object for the Given input
     * @param string $input
     * @return \System\Http\UploadedFile
     */
    public function file($input)
    {
        // If File Exist then Return it
        if(isset($this->files[$input])) {

            return $this->files[$input];
        }

        // Object from UploadedFIle CLass
        $uploadedFile = new UploadedFile($input);

        // Store this object in $this->files  array
        $this->files[$input] = $uploadedFile;

        // Return Object
        return $this->files[$input];


    }

    /**
     * get value from _SERVER by the given key
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function server($key, $default = null)
    {
        return array_get($_SERVER, $key, $default);
    }

    /**
     * Get current request Method
     * @return string
     */
    public function method()
    {
        return $this->server('REQUEST_METHOD');
    }

    /**
     * Get the referer link
     *
     * @return string
     */
    public function referer()
    {
        return $this->server('HTTP_REFERER');
    }

    /**
     * get full url of the script
     *
     * @return string
     */
    public function baseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Get only relative Url ( clean Url )
     *
     * @return string
     */
    public function url()
    {
        return $this->url;
    }

}