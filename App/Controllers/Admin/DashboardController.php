<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/24/17
 * Time: 6:31 PM
 */

namespace App\Controllers\Admin;

use System\Controller;

class DashboardController extends Controller
{
    /**
     * Display Dashboard Design
     *
     * @return mixed
     */
    public function index()
    {
        $data['total_posts'] = $this->load->model('Posts')->count();
        $data['total_comments'] = $this->load->model('Posts')->countComment();
        $data['total_category'] = $this->load->model('Categories')->count();
        $data['total_user'] = $this->load->model('Users')->count();

        $this->html->setTitle('Dashboard');

        $view = $this->view->render('admin/dashboard/home', $data);

        return $this->adminLayout->render($view);

    }

    public function submit()
    {

    }
}