<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/24/17
 * Time: 6:17 PM
 */

namespace App\Controllers\Admin;

use System\Controller;

class PostsController extends Controller
{
    /**
     * Display Users Main Design
     *
     * @return mixed
     */
    public function index()
    {
        // If User Logged Continue to display Users Page

        $this->html->setTitle('Posts');
        // Fetch All Users From DB
        $data['posts'] = $this->load->model('Posts')->all();
        $data['related_posts'] = [];
        $data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;

        // Calling Index View [ list ]  and Passing Data to it
        // Notice: $data['categories'] is an Object NOT Array, it means that we will calling column as $category->id, $category->name
        $view = $this->view->render('admin/posts/list', $data);

        return $this->adminLayout->render($view);

    }

    /**
     * Open Users Group Form
     *
     * @return string
     */
    public function add()
    {

        $data['action'] = $this->url->link('/admin/posts/submit');

        // Get All Categories
        $data['categories'] = $this->load->model('Categories')->all();

        $data['posts'] = $this->load->model('Posts')->all();

        return $this->view->render('admin/posts/form', $data);
    }

    /**
     * submit for creating new Post
     *
     * @return string | json
     */
    public function submit()
    {
        $json = [];

        if($this->isValid()) {

            // There are no errors in Form
            $this->load->model('Posts')->create();

            $json['success'] = 'Posts has been Added';

            $json['redirectTo'] = $this->url->link('/admin/posts');

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
        $postModel = $this->load->model('Posts');


        if(!$postModel->exists($id)) {

            // If this ID not Exist in DB
            return $this->url->redirectTo('/404');
        }

        // Get Data from DB for this users-groups only
        $data['posts'] = $postModel->get($id);

        $data['categories'] = $this->load->model('Categories')->all();

        $data['related_posts'] = $this->load->model('Posts')->all();
//        pre($data['related_posts'] );
//        die();

        // firstly look at [ Save Function in below ] we will return an Errors if exist after Update
        $data['errors'] = $this->session->has('errors') ? $this->session->pull('errors') : null;

        // Set title with name this Category
        $this->html->setTitle('Update', $data['posts']);

        // Calling Update Page from Views and send Category Data to it
        $view = $this->view->render('admin/posts/update-form', $data);

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

            $this->load->model('Posts')->update($id);

            $this->session->set('success', 'Posts Updated');

            return $this->url->redirectTo('/admin/posts');

        } else {
            // we have an errors in Form
            // Get the Errors through getMessage Function
            $this->session->set('errors', $this->validator->getMessage());

            return $this->url->redirectTo('/admin/posts/edit/' . $id);
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
        $postsModel = $this->load->model('Posts');

        if(!$postsModel->exists($id)) {

            return $this->url->redirectTo('/404');
        }

        $postsModel->delete($id);

        $json['success'] = 'Post has been deleted';

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
        $this->validator->required('title', 'Title is Required');
        $this->validator->required('details', 'Details is Required');
        $this->validator->required('tags', 'tags is Required');

        if(is_null($id)) {
            $this->validator->requiredFile('image')->image('image');
        } else {
            $this->validator->image('image');
        }

        return $this->validator->passes();
    }
}