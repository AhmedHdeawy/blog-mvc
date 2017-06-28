<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/24/17
 * Time: 6:17 PM
 */

namespace App\Controllers\Admin;

use System\Controller;

class SettingsController extends Controller
{
    /**
     * Display Users Main Design
     *
     * @return mixed
     */
    public function index()
    {
        // If User Logged Continue to display Users Page

        $this->html->setTitle('Settings');
        // Fetch All Users From DB
        $data['settings'] = $this->load->model('Settings')->all();

        $data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;

        $data['action'] = $this->url->link('admin/settings/save');

        $view = $this->view->render('admin/settings/list', $data);

        return $this->adminLayout->render($view);

    }

    public function add()
    {
        $data['action'] = $this->url->link('/admin/settings/submit');
        $view = $this->view->render('admin/settings/add', $data);
        return $this->adminLayout->render($view);
    }

    /**
     * Add New Settings
     */
    public function submit()
    {
        if($this->isValid()) {

            $this->load->model('Settings')->create();

            $this->session->set('success', 'Settings Added');

            return $this->url->redirectTo('admin/settings');

        }
    }


    /**
     * Validate The Form
     *
     * @param int $id
     * @return bool
     */
    private function isValid($id = null)
    {
        $this->validator->required('key', 'Key Name is Required');
        $this->validator->required('value', 'Value is Required');


        return $this->validator->passes();
    }


}