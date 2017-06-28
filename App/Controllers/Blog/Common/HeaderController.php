<?php

namespace App\Controllers\Blog\Common;


use \System\Controller;

class HeaderController extends Controller
{
    /**
     * Display Header
     *
     * @return mixed
     */
    public function index()
    {
        $data['title'] = $this->html->getTitle();
        $data['user'] = null;
        // Firstly, Check if the User has COOKIE or Not
        $loginModel = $this->load->model('LoginUser');

        $data['isAdmin'] = $loginModel->isAdmin();

        if($loginModel->isLogged()) {

            $data['user'] = $this->load->model('LoginUser')->user();
        }

        return $this->view->render('blog/common/header', $data);
    }

}