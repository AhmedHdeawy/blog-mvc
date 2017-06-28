<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/24/17
 * Time: 4:26 AM
 */

namespace App\Controllers\Admin\Common;

use System\Controller;

class SidebarController extends Controller
{
    /**
     * Display Sidebar
     *
     * @return mixed
     */
    public function index()
    {
        return $this->view->render('admin/common/sidebar');
    }

}