<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/24/17
 * Time: 7:41 PM
 */

namespace System;


class Validation
{

    /**
     * Application Object
     * @var \System\Application
     */
    private $app;

    /**
     * Errors Container
     * @var array
     */
    private $errors = [];

    /**
     * Constructor
     *
     * @param \System\Application
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Determine if the given Input Value is not empty
     *
     * @param string $inputName
     * @param string $customErrorMessage
     *
     * @return $this
     */
    public function required($inputName, $customErrorMessage = null)
    {
        // Check if the given Input has previeus error or Not
        // If has error, then print it before dealing with this error
        if($this->hasError($inputName))
        {
            return $this;
        }

        // Give The given input value in variable
        $inputValue = $this->value($inputName);

        // Check if this value empty or NOT
        if($inputValue === '')
        {
            // If has this error, then Type Message to display it
            $message = $customErrorMessage ?: sprintf('%s Is Required', $inputName);

            // Add This error and this Message to Errors Container array
            $this->addError($inputName, $message);
        }

        // Finally Update Object and return it
        return $this;

    }

    /**
     * Determine if the given File  exist
     *
     * @param string $inputName
     * @param string $customErrorMessage
     *
     * @return $this
     */
    public function requiredFile($inputName, $customErrorMessage = null)
    {
        if($this->hasError($inputName))
        {
            return $this;
        }

        $file = $this->app->request->file($inputName);

        if(! $file->exists()) {
            $message = $customErrorMessage ?: sprintf('%s IS Required', $inputName);
            $this->addError($inputName, $message);
        }

        return $this;
    }

    /**
     * Determine if the given File  is an image
     *
     * @param string $inputName
     * @param string $customErrorMessage
     *
     * @return $this
     */
    public function image($inputName, $customErrorMessage = null)
    {
        if($this->hasError($inputName))
        {
            return $this;
        }

        $file = $this->app->request->file($inputName);

        if(!$file->exists()) {
            return $this;
        }

        if(! $file->isImage()) {
            $message = $customErrorMessage ?: sprintf('%s IS Not Image', $inputName);
            $this->addError($inputName, $message);
        }
        return $this;
    }

    /**
     * Determine if the given Input value is valid Email
     *
     * @param string $inputName
     * @param string $customErrorMessage
     *
     * @return $this
     */
    public function email($inputName, $customErrorMessage = null)
    {
        if($this->hasError($inputName))
        {
            return $this;
        }

        $inputValue = $this->value($inputName);

        if(! filter_var($inputValue, FILTER_VALIDATE_EMAIL))
        {

            $message = $customErrorMessage ?: sprintf('%s Not Valid EMail', $inputName);
            $this->addError($inputName, $message);
        }


        return $this;
    }

    /**
     * Determine if the given Input value is Float
     *
     * @param string $inputName
     * @param string $customErrorMessage
     *
     * @return $this
     */
    public function float($inputName, $customErrorMessage = null)
    {
        if($this->hasError($inputName))
        {
            return $this;
        }

        $inputValue = $this->value($inputName);

        if(! is_float($inputValue)) {
            $message = $customErrorMessage ?: sprintf('%s Not Valid Float Number ', $inputName);
            $this->addError($inputName, $message);
        }

        return $this;
    }

    /**
     * Determine if the given Input value should be at least the given Length
     *
     * @param string $inputName
     * @param string $customErrorMessage
     * @param int $length
     *
     * @return $this
     */
    public function minLen($inputName, $length, $customErrorMessage = null)
    {
        if($this->hasError($inputName))
        {
            return $this;
        }

        $inputValue = $this->value($inputName);

        if(strlen($inputValue) < $length) {

            $message = $customErrorMessage ?: sprintf('%s should be at least %d', $inputName, $length);
            $this->addError($inputName, $message);
        }

        return $this;

    }

    /**
     * Determine if the given Input value should be at most the given Length
     *
     * @param string $inputName
     * @param string $customErrorMessage
     * @param int $length
     *
     * @return $this
     */
    public function maxLen($inputName, $length, $customErrorMessage = null)
    {

        if($this->hasError($inputName))
        {
            return $this;
        }

        $inputValue = $this->value($inputName);

        if($inputValue > $length) {

            $message = $customErrorMessage ?: sprintf('%s should be at most %d', $inputName, $length);
            $this->addError($inputName, $message);
        }

        return $this;
    }



    /**
     * Determine if the given first Input Matches the second input
     *
     * @param string $firstInput
     * @param string $secondInput
     * @param string $customErrorMessage
     *
     * @return $this
     */
    public function match($firstInput, $secondInput, $customErrorMessage = null)
    {
        if($this->hasError($secondInput))
        {
            return $this;
        }

        $firstValue = $this->value($firstInput);
        $secondValue = $this->value($secondInput);

        if($firstValue !== $secondValue) {
            $message = $customErrorMessage ?: sprintf('%s should match %s', $secondInput, $firstInput);
            $this->addError($secondInput, $message);
        }

        return $this;
    }

    /**
     * Determine if the given Input is Unique
     *
     * @param string $inputName
     * @param array $databaseData
     * @param string $customErrorMessage
     *
     * @return $this
     */
    public function unique($inputName, array $databaseData, $customErrorMessage = null)
    {
        if($this->hasError($inputName))
        {
            return $this;
        }

        $inputValue = $this->value($inputName);

        $table = null;
        $column = null;
        $exceptionColumn = null;
        $exceptionColumnValue = null;

        if(count($databaseData) == 2) {
            list($table, $column) = $databaseData;
        } elseif (count($databaseData) == 4) {
            list($table, $column, $exceptionColumn, $exceptionColumnValue) = $databaseData;
        }

        if($exceptionColumn AND $exceptionColumnValue) {

            $result = $this->app->db->select($column)->from($table)->where($column . " = ? AND " . $exceptionColumn . " != " . $exceptionColumnValue, $inputValue)->fetch();
        } else{

            $result = $this->app->db->select($column)->from($table)->where($column . " = ? ", $inputValue)->fetch();
        }


        if($result) {
            $message = $customErrorMessage ?: sprintf('%s Already Exist', $inputName);
            $this->addError($inputName, $message);
        }

        return $this;
    }

    /**
     * Add Custom Message
     *
     * @param string $message
     *
     * @return $this
     */
    public function message($message)
    {
        $this->errors[] = $message;

        return $this;
    }

    /**
     * Validate All inputs
     *
     * @return $this
     */
    public function validate()
    {

    }

    /**
     * Determine if All input are valid
     *
     * @return bool
     */
    public function passes()
    {
        return empty($this->errors);
    }

    /**
     * Determine if there ara any Invalid input
     *
     * @return bool
     */
    public function fails()
    {
        return !empty($this->errors);
    }

    /**
     * Get All Errors
     *
     * @return array
     */
    public function getMessage()
    {
        return $this->errors;
    }

    /**
     * Flatten Errors and make it as a string imploded with break
     *
     * @return string
     */
    public function flattenMessage()
    {
        return implode('<br/>', $this->errors);
    }

    /**
     * Get Value for the given input
     *
     * @param string $inputName
     * @return mixed
     */
    public function value($inputName)
    {
        return $this->app->request->post($inputName);

    }

    /**
     * Add input Error
     *
     * @param string $inputName
     * @paran string $errorMessage
     *
     * @return void
     */
    private function addError($inputName, $errorMessage)
    {
            $this->errors[$inputName] = $errorMessage;
    }

    /**
     * Determine if the given input has previous error
     *
     * @param string $inputName
     * @return bool
     */
    private function hasError($inputName)
    {
        return array_key_exists($inputName, $this->errors);
    }

}