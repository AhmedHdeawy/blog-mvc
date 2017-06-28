<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/05/17
 * Time: 10:00 ص
 */

namespace System\View;

use System\File;


class View implements ViewInterface
{

    /**
     * FIle Object
     *
     * @var \System\File
     */
    private $file;

    /**
     * View Path
     * @var string
     */
    private $viewPath;

    /**
     * Passed Data "variables" to the view path
     *
     * @var array
     */
    private $data = [];

    /**
     * the output from the view path
     *
     * @var string
     */
    private $output;

    /**
     * Constructor
     *
     * @param \System\File $file
     * @param string $viewPath
     * @param array $data
     */
    public function __construct(File $file, $viewPath, array $data)
    {
        $this->file = $file;

        $this->preparePath($viewPath);

        $this->data = $data;
    }

    /**
     * Prepare View path
     *
     * @param string $viewPath
     * @return void
     */
    private function preparePath($viewPath)
    {
        // Generate Full path to the given Path
        $relativeViewPath = 'App/Views/' . $viewPath . '.php';

        // store full path in ViewPath
        $this->viewPath = $this->file->to($relativeViewPath);

        // check if exists or no
        if(! $this->viewFileExists($relativeViewPath))
        {
            die($viewPath . " doesn't exist in Views");
        }

    }

    /**
     * Determine if the view file exists
     *
     * @param string $viewPath
     * @return bool
     */
    private function viewFileExists($viewPath)
    {
        // Check if View Exist in Views Folder [ exists function in File Class ]
        return $this->file->exists($viewPath);
    }


    /**
     * Get the view output
     *
     * @return string
     */
    public function getOutput()
    {
        if(is_null($this->output))
        {
            ob_start();

            // Extract Data from $this->data  to passed it in Response
            extract($this->data);

            require $this->viewPath;

            $this->output = ob_get_clean();
        }

        return $this->output;
    }

    /**
     * Convert the view object to string in printing
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getOutput();
    }
}