<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/05/17
 * Time: 10:05 ص
 */

namespace System\View;


interface ViewInterface
{

    /**
     * Get the view output
     *
     * @return string
     */
    public function getOutput();

    /**
     * Convert the view object to string in printing
     *
     * @return string
     */
    public function __toString();

}