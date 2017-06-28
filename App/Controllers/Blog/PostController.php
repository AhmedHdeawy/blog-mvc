<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 14/05/17
 * Time: 11:46 ص
 */

namespace App\Controllers\Blog;

use \System\Controller;

class PostController extends Controller
{
    public function index($title, $id)
    {

        $post = $this->load->model('Posts')->getPostWithComments($id);

        $related = $this->getRelated($post->related_posts);

        if(!in_array(null, $related)){

            $data['relatedPosts'] = $related;
        } else {

            $data['relatedPosts'] = null;
        }
        if(! $post) return $this->url->redirectTo('/404');

        $this->html->setTitle($title);

        $data['post'] = $post;

        $data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;
        $data['errors'] = $this->session->has('errors') ? $this->session->pull('errors') : null;

        $data['user'] = null;
        // Firstly, Check if the User has COOKIE or Session
        $loginModel = $this->load->model('LoginUser');

        if($loginModel->isLogged()) {

            $data['user'] = $this->load->model('LoginUser')->user();
        }

        $view =  $this->view->render('blog/blogdetails', $data);
        return $this->blogLayout->render($view);

    }

    /**
     * Get Related Posts
     * @param array $ids
     * @return array
     */
    private function getRelated($ids)
    {
        $related = explode(',', $ids);
        $data['related'] = [];
        foreach ($related AS $id) {
            $data['related'][] = $this->load->model('Posts')->get($id);
        }
        return $data['related'];
    }

    /**
     * Get Posts based on TAGS
     * @param string tag
     * @return array
     */
    public function tags($tags, $id)
    {

    }

    /**
     * Add Comment for current Article
     * @param int $id
     * @return void
     */
    public function addComment($title, $id)
    {

        if($this->isValid()) {

            $user = $this->load->model('Users')->getUser();
            $userID = $user->id;
            $this->load->model('Posts')->addComment($id, $userID);

            $this->session->set('success', 'Your Comment is Added');

            return $this->url->redirectTo('/post/' . $title . '/' . $id);

        } else {

            $this->session->set('errors', $this->validator->getMessage());
            return $this->url->redirectTo('/post/' . $title . '/' . $id);
        }

    }

    /**
     * Validate The Form
     *
     * @return bool
     */
    private function isValid()
    {
        $this->validator->required('comment', 'Comment is Required');

        return $this->validator->passes();
    }

}