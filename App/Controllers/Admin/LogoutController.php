<?php

namespace App\Controllers\Admin;
use System\Database;

use \System\Controller;

class LogoutController extends Controller
{
    /**
     * Display Login Form
     *
     * @return mixed
     */
    public function index()
    {

        setcookie("login", "", time() - 3600);
        $this->session->destroy();
        $this->cookie->destroy();

        return $this->url->redirectTo('admin/login');

    }


}