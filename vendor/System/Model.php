<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/20/17
 * Time: 8:29 AM
 */

namespace System;

abstract class Model
{

    /**
     * Application Object
     *
     * @var \System\Application
     */
    protected $app;

    /**
     * Table Name
     * @var string
     */
    protected $table;

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

    /**
     * Call Database Methods dynamically
     *
     * @param string $method
     * @param array $arguments
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->app->db, $method], $arguments);
    }

    // Base Methods that i will use it in  All Models

    /**
     * Get All Model Records
     *
     * @return array
     */
    public function getAll()
    {
        return $this->fetchAll($this->table);
    }

    /**
     * Get Current Record
     *
     * @param int $id
     * @return \stdClass/ null
     */
    public function get($id)
    {
        return $this->where('id = ?', $id)->fetch($this->table);
    }

    /**
     * Determine if the given value of key is exists
     *
     * @param mixed $key
     * @param mixed $value
     * @return bool
     */
    public function exists($value, $key = 'id')
    {
        return (bool) $this->select($key)->where($key . " = ? ", $value)->fetch($this->table);

    }

    /**
     * Delete Record
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        return $this->where('id = ? ', $id)->delete($this->table);
    }

}