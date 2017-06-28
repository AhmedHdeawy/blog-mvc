<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/20/17
 * Time: 9:31 AM
 */

namespace System;


class Html
{
    /**
     * Application Object
     *
     * @var \System\Application
     */
    protected $app;

    /**
     * Html Title
     * @var string $title
     */
    private $title;

    /**
     * Html Description
     * @var string $title
     */
    private $description;

    /**
     * Html Keywords
     * @var string $title
     */
    private $keywords;


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
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param string $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }





}