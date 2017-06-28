<?php

namespace App\Controllers\Admin;
use System\Database;

use \System\Controller;

class UsersGroupsController extends Controller
{
    /**
     * Display Category Main Design
     *
     * @return mixed
     */
    public function index()
    {

        // If User Logged Continue to display Users Group Page

        $this->html->setTitle('Users Group');

        // Fetch All Categories From DB
        $data['users_groups'] = $this->load->model('UsersGroups')->getAll();

        $data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;


        // Calling Index View [ list ]  and Passing Data to it
        // Notice: $data['categories'] is an Object NOT Array, it means that we will calling column as $category->id, $category->name
        $view = $this->view->render('admin/users-groups/list', $data);

        return $this->adminLayout->render($view);



    }

    /**
     * Open Users Group Form
     *
     * @return string
     */
    public function add()
    {
        $data['action'] = $this->url->link('/admin/users-groups/submit');

        $data['pages'] = $this->getPermissionPages();

        return $this->view->render('admin/users-groups/form', $data);
    }

    /**
     * submit for creating new category
     *
     * @return string | json
     */
    public function submit()
    {
        $json = [];

        if($this->isValid()) {

            // There are no errors in Form

            $this->load->model('UsersGroups')->create();

            $json['success'] = 'Users Groups Added';

            $json['redirectTo'] = $this->url->link('/admin/users-groups');

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
        $usersGroupsModel = $this->load->model('UsersGroups');


        if(!$usersGroupsModel->exists($id)) {

            // If this ID not Exist in DB
            return $this->url->redirectTo('/404');
        }

        $userGroup = $usersGroupsModel->get($id);

        // Get Data from DB for this users-groups only
        $data['users_groups'] = $usersGroupsModel->get($id);

        // Get All Stored Pages
        $data['pages'] = $this->getPermissionPages();

        $data['users_group_pages'] = $userGroup ? $userGroup->pages : [];

        // firstly look at [ Save Function in below ] we will return an Errors if exist after Update
        $data['errors'] = $this->session->has('errors') ? $this->session->pull('errors') : null;

        // Set title with name this Category
        $this->html->setTitle('Update', $data['users_groups']);

        // Calling Update Page from Views and send Category Data to it
        $view = $this->view->render('admin/users-groups/update-form', $data);

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

        if($this->isValid()) {

            // There are no errors in Form

            $this->load->model('UsersGroups')->update($id);

            $this->session->set('success', 'Users Groups Updated');

            return $this->url->redirectTo('/admin/users-groups');

        } else {

            // we have an errors in Form
            // Get the Errors through getMessage Function
            $this->session->set('errors', $this->validator->getMessage());

            return $this->url->redirectTo('/admin/users-groups/edit/' . $id);
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
        $usersGroupsModel = $this->load->model('UsersGroups');

        if(!$usersGroupsModel->exists($id) OR $id == 1) {

            return $this->url->redirectTo('/404');
        }

        $usersGroupsModel->delete($id);

        $json['success'] = 'users-groups has been deleted';

        return json_encode($json);

    }

    /**
     * Validate The Form
     *
     * @return bool
     */
    private function isValid()
    {
        $this->validator->required('name', 'users-groups Name is Required');

        return $this->validator->passes();
    }


    /**
     * Get Permission Pages
     *
     * @return array
     */
    private function getPermissionPages()
    {
        $permissions = [];

        foreach ($this->route->routes() AS $route) {

            // Store All URLs started with '/admin'
            if(strpos($route['url'], '/admin') === 0) {

                $permissions[] = $route['url'];
            }

        }

        return $permissions;
    }

}