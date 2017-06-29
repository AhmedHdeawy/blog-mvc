<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 14/05/17
 * Time: 11:46 ص
 */

namespace App\Controllers\Blog;

use \System\Controller;

class HomeController extends Controller
{
    public function index()
    {
        
        $data['setting'] = $this->load->model('Settings')->get('Site_Name')->value;

        $this->html->setTitle($data['setting']);

        $data['posts'] = $this->load->model('Posts')->latest(8, 0);

        $data['categories'] = $this->load->model('Categories')->getEnabledCategoriesWithNumberOfPosts();

        $view =  $this->view->render('blog/home', $data);
        return $this->blogLayout->render($view);

    }

}