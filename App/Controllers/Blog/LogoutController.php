<?php

namespace App\Controllers\Blog;
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
        $this->session->remove('user');
        $this->cookie->remove('user');

        return $this->url->redirectTo('/');

    }


}