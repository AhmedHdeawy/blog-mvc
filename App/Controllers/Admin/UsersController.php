<?php

namespace App\Controllers\Admin;
use System\Database;

use \System\Controller;

class UsersController extends Controller
{
    /**
     * Display Users Main Design
     *
     * @return mixed
     */
    public function index()
    {
        // If User Logged Continue to display Users Page

        $this->html->setTitle('Users');
        // Fetch All Users From DB
        $data['users'] = $this->load->model('Users')->all();

        $data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;


        // Calling Index View [ list ]  and Passing Data to it
        // Notice: $data['categories'] is an Object NOT Array, it means that we will calling column as $category->id, $category->name
        $view = $this->view->render('admin/users/list', $data);

        return $this->adminLayout->render($view);

    }

    /**
     * Open Users Group Form
     *
     * @return string
     */
    public function add()
    {

        $data['action'] = $this->url->link('/admin/users/submit');

        // Load All UsersGroup from UserGroup Table
        $data['users_group'] = $this->load->model('UsersGroups')->all();

        return $this->view->render('admin/users/form', $data);
    }

    /**
     * submit for creating new User
     *
     * @return string | json
     */
    public function submit()
    {
        $json = [];

        if($this->isValid()) {

            // There are no errors in Form

            $this->load->model('Users')->create();

            $json['success'] = 'Users has been Added';

            $json['redirectTo'] = $this->url->link('/admin/users');

        } else {
            // we have an errors in Form
            // Get the Errors through getMessage Function
            $json['errors'] = $this->validator->flattenMessage();
        }

        return json_encode($json);
    }


    /**
     * Update Form Data
     *
     * @param int $id
     */
    public function edit($id)
    {
        // Calling Model
        $usersModel = $this->load->model('Users');


        if(!$usersModel->exists($id)) {

            // If this ID not Exist in DB
            return $this->url->redirectTo('/404');
        }

        // Get Data from DB for this users-groups only
        $data['users'] = $usersModel->get($id);

        // Load All UsersGroup from UserGroup Table
        $data['users_group'] = $this->load->model('UsersGroups')->all();

        // firstly look at [ Save Function in below ] we will return an Errors if exist after Update
        $data['errors'] = $this->session->has('errors') ? $this->session->pull('errors') : null;

        // Set title with name this Category
        $this->html->setTitle('Update', $data['users']);

        // Calling Update Page from Views and send Category Data to it
        $view = $this->view->render('admin/users/update-form', $data);

        // return view
        return $this->adminLayout->render($view);

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

            $this->load->model('Users')->update($id);

            $this->session->set('success', 'Users Updated');

            return $this->url->redirectTo('/admin/users');

        } else {

            // we have an errors in Form
            // Get the Errors through getMessage Function
            $this->session->set('errors', $this->validator->getMessage());

            return $this->url->redirectTo('/admin/users/edit/' . $id);
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
        $usersModel = $this->load->model('Users');

        if(!$usersModel->exists($id) OR $id == 1) {

            return $this->url->redirectTo('/404');
        }

        $usersModel->delete($id);

        $json['success'] = 'users has been deleted';

        return json_encode($json);

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