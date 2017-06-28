<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 14/05/17
 * Time: 11:46 ص
 */

namespace App\Controllers\Blog;

use \System\Controller;

class CategoryController extends Controller
{
    public function index($title, $id)
    {

        $category = $this->load->model('Categories')->getCategoryWithPosts($id);

        if(! $category) {
            //return $this->url->redirectTo('/404');
              $data['categories'] = null;
        }

        $this->html->setTitle($title);

        $data['categories'] = $category;

        /* Pagination Steps :-
         * first we will get total posts for the category
         * and we will limit the grabbed posts for the category
         * i.e. 1   " web development " Category has 90 Articles
         * total posts      => 90
         * items per page   => 10
         * current page     => 1
         * offset           => items per page * (current page -1 )
         * total pages      => 9 => last page
         * last page == total items / items per page
         *
         * i.e. 2
         * starting from the offset
         * assuming the current page is 1 => first page
         * then our offset will be  => 10 * ( 1 - 1) == 0
         *
         * assuming the current page is 2 => second page
         * then our offset will be  => 10 * ( 2 - 1) == 10
         *
         * assuming the current page is 3 => third page
         * then our offset will be  => 10 * ( 3 - 1) == 20
         *
         */
        $data['pagination'] = $this->pagination->paginate();

        $view =  $this->view->render('blog/posts', $data);
        return $this->blogLayout->render($view);

    }

}