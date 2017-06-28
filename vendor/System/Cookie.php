<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/20/17
 * Time: 9:19 AM
 */

namespace System;


class Cookie
{

    /**
     * Application Object
     */
    private $app;

    /**
     * Cookies Path
     * @var string
     */
    private $path = '/';

    /**
     * Cookie constructor.
     * @param \System\Application $app
     */
    public function __construct($app)
    {
        $this->app = $app;

        // we will get the path from $_SERVER['SCRIPT_NAME'] index from _SERVER
        // we will remove or just get the directory from the script name
        // the file name from it => we will remove index.php
        $this->path = dirname($this->app->request->server('SCRIPT_NAME'));
    }

    /**
     * Set new value to Cookie
     * @param string $key
     * @param mixed $value
     * @param int $hours
     * @return void
     */
    public function set($key, $value, $hours = 100)
    {
        $expireTime = $hours == -1 ? -1 : time() + $hours * 3600;
        setcookie($key, $value, $expireTime, '/', '', false, true);
    }

    /**
     * get new value from Cookie
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return array_get($_COOKIE, $key, $default);
    }

    /**
     * Determine if the given key exist in Cookie
     *
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $_COOKIE);
    }

    /**
     * Remove the given key from Cookie
     *
     * @param string $key
     * @return void
     */
    public function remove($key)
    {
        $this->set($key, null, -1);

        unset($_COOKIE[$key]);
    }

    /**
     * Get all Cookie data
     *
     * @return array
     */
    public function all()
    {
        return $_COOKIE;
    }

    /**
     * Destroy the Cookie
     *
     * @return void
     */
    public function destroy()
    {
        foreach (array_keys($this->all()) as $key) {

            $this->remove($key);
        }
//        unset($_COOKIE);


    }


}