<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/24/17
 * Time: 4:27 AM
 */

namespace App\Controllers\Admin\Common;

use System\Controller;

class FooterController extends Controller
{

    /**
     * Display Login Form
     *
     * @return mixed
     */
    public function index()
    {
        $data['user'] = $this->load->model('Login')->user();

        return $this->view->render('admin/common/footer', $data);
    }
}