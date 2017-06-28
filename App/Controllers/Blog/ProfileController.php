<?php

namespace App\Controllers\Blog;
use System\Database;

use \System\Controller;

class ProfileController extends Controller
{
    /**
     * Display Profile Main Design
     *
     * @return mixed
     */
    public function index()
    {

        // check if user Logging
        $loginModel = $this->load->model('LoginUser');
        if(!$loginModel->isLogged()) {
            // If this User not Exist Then 404 Error
            // Page Access Denied
            return $this->url->redirectTo('/404');
        }

        $this->html->setTitle('Profile Page');

        // If User Logged Continue to display Profile Page and Details
        $data['user'] = $this->load->model('Profile')->profile();

        $data['success'] = $this->session->has('done') ? $this->session->pull('done') : null;
        $data['errors'] = $this->session->has('failed') ? $this->session->pull('failed') : null;

        // Calling Index View [ list ]  and Passing Data to it
        // Notice: $data['categories'] is an Object NOT Array, it means that we will calling column as $category->id, $category->name
        $view = $this->view->render('blog/user/profile', $data);

        return $this->blogLayout->render($view);

    }

    /**
     * Save for Update users-groups
     *
     * @param int $id
     * @return string
     */
    public function save($id)
    {
        if($this->isValid($id)) {

            // There are no errors in Form

            $this->load->model('Profile')->update($id);

            $this->session->set('done', 'Your Profile is Updated');

            return $this->url->redirectTo('/profile');

        } else {
            // we have an errors in Form
            // Get the Errors through getMessage Function
            $this->session->set('failed', $this->validator->getMessage());

            return $this->url->redirectTo('/profile');
        }

    }

    /**
     * Delete Record
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $usersModel = $this->load->model('Profile');

        if(!$usersModel->exists($id) OR $id == 1) {

            return $this->url->redirectTo('/404');
        }

        $usersModel->delete($id);

        $this->load->controller('Blog/Logout')->index();

//        $this->session->remove('user');
//        $this->cookie->remove('user');

        //return $this->url->redirectTo('/');

    }

    /**
     * Validate The Form
     *
     * @param int $id
     * @return bool
     */
    private function isValid($id = null)
    {
        $this->validator->required('first_name', 'First Name is Required');
        $this->validator->required('last_name', 'Last Name is Required');
        $this->validator->required('email', 'Email is Required');
        $this->validator->unique('email', ['users', 'email','id', $id]);

        if(is_null($id)) {
            // if ID is null, then this is [ Create Process ], Validation Required
            // if NOT, then this is [ Update Process ], Validation Optionally
            $this->validator->required('password')->minLen('password', 8)->match('password', 'confirm_password');

            $this->validator->requiredFile('image')->image('image');
        } else {
            $this->validator->image('image');
        }

        return $this->validator->passes();
    }

}