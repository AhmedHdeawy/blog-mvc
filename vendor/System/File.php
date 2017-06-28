<?php

namespace System;

class File
{
    const DS = DIRECTORY_SEPARATOR;

    /***
     * Root Path
     *
     * @param string $root.
     */
    private $root;


    /***
     * Constructor.
     * @param string $root
     *
     */
    public function __construct($root)
    {
        $this->root = $root;
    }

    /**
     * Determine whether File Exist or Not
     * @param string $file
     * @return boolean
     */
    public function exists($file)
    {
        return file_exists($this->to($file));
    }

    /**
     * Require the given file
     *
     * @param string $file
     * @return void
     */
    public function requireFile($file)
    {
        return require $this->to($file);
    }

    /**
     * Return full path to the given file from vendor Folder
     *
     * @param string $path
     * @return string
     */
    public function toVendor($path)
    {
        return $this->to( 'vendor/' .  $path);
    }

    /**
     * Return full path to the given file from Public Folder
     *
     * @param string $path
     * @return string
     */
    public function toPublic($path)
    {
        return $this->to( 'public/' .  $path);
    }

    /**
     * generate full path to the given path
     *
     * @param string $path
     *
     * @return string
     */
    public function to($path)
    {
        return $this->root . static::DS . str_replace(['/', '\\'], static::DS , $path);
    }

}