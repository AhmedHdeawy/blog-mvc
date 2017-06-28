<?php

namespace App\Controllers\Blog;
use System\Database;

use \System\Controller;

class LoginController extends Controller
{
    /**
     * Display Login Form
     *
     * @return mixed
     */
    public function index()
    {
        // Firstly, Check if the User has COOKIE or Not
        $loginModel = $this->load->model('LoginUser');


        if($loginModel->isLogged()) {

            return $this->url->redirectTo('/');
        }

        // Get Errors to passing it with Index when Submit the Form
        // to understand it Look in below at submit Function
        $data['errors'] = $this->errors;

        return $this->view->render('blog/users/login', $data);

    }

    /**
     * Submit Form
     * @return mixed
     */
    public function submit()
    {
        if($this->isValid()) {

            // Calling LoginModel
            $loginModel = $this->load->model('LoginUser');

            if($this->request->post('remember')) {

                // Save Login data in Cookies
                $this->cookie->set('user', $loginModel->user()->code);
                // Save Login data in Session
                $this->session->set('user', $loginModel->user()->code);

            } else {

                // Save Login data in Session
                $this->session->set('user', $loginModel->user()->code);

            }

            // if All Right, Then Redirect to Admin Dashboard with JSON Data
            $json = [];
            $json['success'] = 'Welcome Back ' . $loginModel->user()->first_name;

            $json['redirect'] = $this->url->link('/');

            return json_encode($json);

        } else {

            // Calling Index Method Again to Return Errors and View it in User view

            $json = [];
            $json['errors'] = implode('<br>', $this->errors);
            return json_encode($json);

            //return $this->index();
        }
    }

    /**
     * Validate Data
     *
     * @return bool
     */
    private function isValid()
    {
        $email = $this->request->post('email');
        $password = $this->request->post('password');

        // Check and Validate Email
        if(! $email) {
            $this->errors[] = "Please Insert Email";
        } elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Please Insert a valid email";
        }

        // Check and validate Password
        if(! $password) {
            $this->errors[] = "Please Insert Password";
        }

        // if Data is Valid, Then check if it exist in Database
        if(! $this->errors) {

            // Calling LoginModel
            $loginModel = $this->load->model('LoginUser');

            // Calling isValidLogin Method which Check if email and password are Exists in DB
            if(! $loginModel->isValidLogin($email, $password)) {
                $this->errors[] = "Invalid Login Data";
            }
        }

        return empty($this->errors);
    }

}