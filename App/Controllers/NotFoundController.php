<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/21/17
 * Time: 4:22 AM
 */

namespace App\Controllers;


use System\Controller;

class NotFoundController extends Controller
{

    public function index()
    {
        return $this->view->render('not-found');
    }

}