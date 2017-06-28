<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/24/17
 * Time: 4:26 AM
 */

namespace App\Controllers\Blog\Common;

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
        $data['categories'] = $this->load->model('Categories')->getEnabledCategoriesWithNumberOfPosts();

        return $this->view->render('blog/common/sidebar', $data);
    }

}