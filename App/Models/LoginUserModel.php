<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/20/17
 * Time: 5:29 PM
 */

namespace App\Models;

use System\Model;

class LoginUserModel extends Model
{

    /**
     * Table Name
     * @var string
     */
    protected $table= "users";

    /**
     * Logged in User
     * @var \stdClass
     */
    private $user = [];

    /**
     * Determine if the given login data is valid
     *
     * @param string $email
     * @param string $password
     *
     * @return bool
     */
    public function isValidLogin($email, $password)
    {
        // Calling ( Where ) Function from Database Class through [ __call() ] Method in Model Class
        $user = $this->where('email = ?', $email)->fetch($this->table);

        // if Data is empty which means theres no Email fetched
        if(! $user) {
            return false;
        }

        // Get User Data in variable to use it in Controller Class
        $this->user = $user;

        // Chekc if Password Agreement with Password in Database
        return password_verify($password, $user->password);

    }

    /**
     * Check if The User has a cookie or Session
     * @return bool
     */
    public function isLogged()
    {

        $code = '';
        // If This User has  Cookie, Then Get its value
        if($this->cookie->has('user')) {

            $code = $this->cookie->get('user');

        } elseif ($this->session->has('user')) {

            $code = $this->session->get('user');

        }

        // Compare This [ Code ] With [ Code ] in DB
        $user = $this->where('code = ?', $code)->fetch($this->table);

        if(! $user) { return false;}

        // Store User to use it an another Pages
        $this->user = $user;

        return true;
    }

    /**
     * Check if this User is an Admin
     * @return void
     */
    public function isAdmin()
    {
        $code = '';
        // If This User has  Cookie, Then Get its value
        if($this->cookie->has('user')) {

            $code = $this->cookie->get('user');

        } elseif ($this->session->has('user')) {

            $code = $this->session->get('user');

        }

        // Compare This [ Code ] With [ Code ] in DB
        $user = $this->where('code = ? AND user_group_id = ? ', $code, 1)->fetch($this->table);

        if($user) return true;

        return false;

    }

    /**
     * Get Logged User Data
     *
     * @return \stdClass
     */
    public function user()
    {
        return $this->user;
    }
}