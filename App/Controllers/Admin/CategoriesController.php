<?php

namespace App\Controllers\Admin;

use \System\Controller;

class CategoriesController extends Controller
{
    /**
     * Display Category Main Design
     *
     * @return mixed
     */
    public function index()
    {

        // If User Logged Continue to display Categories Page

        $this->html->setTitle('Categories');

        // Fetch All Categories From DB
        $data['categories'] = $this->load->model('Categories')->getAll();

        $data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;


        // Calling Index View [ list ]  and Passing Data to it
        // Notice: $data['categories'] is an Object NOT Array, it means that we will calling column as $category->id, $category->name
        $view = $this->view->render('admin/categories/list', $data);

        return $this->adminLayout->render($view);
    }

    /**
     * Open Category Form
     *
     * @return string
     */
    public function add()
    {
        $data['action'] = $this->url->link('/admin/categories/submit');

        return $this->view->render('admin/categories/form', $data);
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
            $this->load->model('Categories')->create();

            $json['success'] = 'Category Added';

            $json['redirectTo'] = $this->url->link('/admin/categories');

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
        $categoriesModel = $this->load->model('Categories');


        if(!$categoriesModel->exists($id)) {

            // If this ID not Exist in DB
            return $this->url->redirectTo('/404');
        }

        // Get Data from DB for this Category only
        $data['category'] = $categoriesModel->get($id);

        // firstly look at [ Save Function in below ] we will return an Errors if exist after Update
        $data['errors'] = $this->session->has('errors') ? $this->session->pull('errors') : null;

        // Set title with name this Category
        $this->html->setTitle('Update', $data['category']);

        // Calling Update Page from Views and send Category Data to it
        $view = $this->view->render('admin/categories/update-form', $data);

        // return view
        return $this->adminLayout->render($view);

    }

    /**
     * Save for Update category
     *
     * @param int $id
     * @return string
     */
    public function save()
    {

        if($this->isValid()) {

            // There are no errors in Form

            $this->load->model('Categories')->update($id);

            $this->session->set('success', 'Category Updated');

            return $this->url->redirectTo('/admin/categories');

        } else {

            // we have an errors in Form
            // Get the Errors through getMessage Function
            $this->session->set('errors', $this->validator->getMessage());

            return $this->url->redirectTo('/admin/categories/edit/' . $id);
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
        $categoryModel = $this->load->model('Categories');

        if(!$categoryModel->exists($id)) {

            return $this->url->redirectTo('/404');
        }

        $categoryModel->delete($id);

        $json['success'] = 'Category has been deleted';

        return json_encode($json);

    }

    /**
     * Validate The Form
     *
     * @return bool
     */
    private function isValid()
    {
        $this->validator->required('name', 'Category Name is Required');

        return $this->validator->passes();
    }

}