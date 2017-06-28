<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 14/05/17
 * Time: 11:46 ص
 */

namespace App\Controllers\Blog;

use \System\Controller;

class SearchController extends Controller
{
    public function index()
    {
       $query =  $this->request->get('q');

       $posts = $this->load->model('Posts')->getPostsSearched($query);

        if(! $posts) {
            //return $this->url->redirectTo('/404');
            $data['posts'] = null;
        }

        $this->html->setTitle($query);

        $data['posts'] = $posts;

        // Pagination
        $data['pagination'] = $this->pagination->paginate();

        $view =  $this->view->render('blog/search', $data);
        return $this->blogLayout->render($view);

    }

}