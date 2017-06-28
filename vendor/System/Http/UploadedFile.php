<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/25/17
 * Time: 10:30 PM
 */

namespace System\Http;

use System\Application;

class UploadedFile
{

    /**
     * Application Object
     * @var \System\Application
     */
    private $app;

    /**
     * The Uploaded File
     * @var string
     */
    private $file = [];

    /**
     * The Uploaded File Name With Extension
     * @var string
     */
    private $fileName;

    /**
     * The Uploaded File Name Without Extension
     * @var string
     */
    private $nameOnly;

    /**
     * The Uploaded File Extension
     * @var string
     */
    private $extension;

    /**
     * The Uploaded File MIME type
     * @var string
     */
    private $mimeType;

    /**
     * The Uploaded Temp File path
     * @var string
     */
    private $temp;

    /**
     * The Uploaded File Size
     * @var int
     */
    private $size;

    /**
     * The Uploaded File Errors
     * @var int
     */
    private $error;

    /**
     * Allowed Image Extension
     *
     * @var array
     */
    private $allowedImageExtension = ['gif', 'jpg', 'jpeg', 'webp', 'png', 'tiff', 'psd'];

    /**
     * Constructor
     *
     * @param string $input
     */
    public function __construct( $input)
    {

        $this->getFileInfo($input);
    }

    /**
     * Collect the given input File Data
     *
     * @param string $input
     *
     * @return void
     */
    private function getFileInfo($input)
    {
        if(empty($_FILES[$input])) {
            return;
        }

        $file = $_FILES[$input];

        // Get Error firstly to check Is file uploaded or Not ?
        $this->error = $file['error'];

        // Check Errors
        if($this->error != UPLOAD_ERR_OK) {
            // if $this->error != 0    Then Error Exist
            return;
        }

        $this->file = $file;

        $this->fileName = $this->file['name'];

        $fileNameInfo = pathinfo($this->fileName);

        $this->nameOnly = $fileNameInfo['filename'];
        $this->extension = strtolower($fileNameInfo['extension']);

        $this->mimeType = $this->file['type'];
        $this->temp = $this->file['tmp_name'];
        $this->size = $this->file['size'];


    }

    /**
     * Determine is the file is uploaded
     *
     * @return bool
     */
    public function exists()
    {
        return !empty($this->file);
    }

    /**
     * Get File Name
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Get File Name Only without Extension
     *
     * @return string
     */
    public function getFileNameOnly()
    {
        return $this->nameOnly;
    }

    /**
     * Get Temp File Name
     *
     * @return string
     */
    public function getTempFileName()
    {
        return $this->temp;
    }

    /**
     * Get File Extension
     *
     * @return string
     */
    public function getFileExtension()
    {
        return $this->extension;
    }

    /**
     * Get File Type
     *
     * @return string
     */
    public function getFileType()
    {
        return $this->mimeType;
    }

    /**
     * Get File Size
     *
     * @return string
     */
    public function getFileSize()
    {
        return $this->size;
    }

    /**
     * Determine if Uploaded file Image or Not
     * @return bool
     */
    public function isImage()
    {
        if(strpos($this->mimeType, 'image/') === 0 AND in_array($this->extension, $this->allowedImageExtension)) {

            return true;
        }

        return false;
    }

    /**
     * Move file to the given Destination
     *
     * @param string $target
     * @param string $newFileName
     *
     * @return string
     */
    public function move($target, $newFileName = null)
    {
        // Generate File Name if the given name NULL
        $fileName = $newFileName ?: sha1(mt_rand()) . '_' . sha1(mt_rand());

        // Concatenate fileName with Extension
        $fileName .= '.' . $this->extension;

        // Check if the given Directory Exist
        if(! is_dir($target)) {

            // If Not Exist, Create It recursive
            mkdir($target, 0774, true);
        }

        // public/images/file.extension
        $uploadedFilePath = rtrim($target, '/') . '/' . $fileName;

        // Move The File to the given Target
        move_uploaded_file($this->temp, $uploadedFilePath);

        return $fileName;
    }



}