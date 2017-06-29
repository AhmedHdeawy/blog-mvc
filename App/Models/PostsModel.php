<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 6/12/17
 * Time: 1:53 PM
 */

namespace App\Models;

use System\Model;
use PDO;

class PostsModel  extends Model
{


    /**
     * Table Name
     * @var string
     */
    protected $table = 'posts';


    /**
     * Upload Image
     *
     * @return string
     */
    private function imageUpload()
    {
        $image = $this->request->file('image');


        if(!$image->exists()) {
            return "";
        }
        return $image->move($this->app->file->toPublic('postImages'));
    }

    /**
     * Get All Posts
     * @return void
     */
    public function all()
    {
        return $this->select('p.*', 'c.name AS `category`', 'u.first_name ', 'u.last_name')
                    ->from('posts p')
                    ->join('LEFT JOIN categories c ON p.category_id = c.id')
                    ->join('LEFT JOIN users u ON p.user_id = u.id')
                    ->fetchAll();
    }

    /**
     * Get Number of rows in Table
     * @return int
     */
    public function count()
    {
        return $this->select('COUNT(id) AS total')->from('posts')->fetch();

    }

    /**
     * Get Number of rows in Table
     * @return int
     */
    public function countComment()
    {
        return $this->select('COUNT(id) AS total')->from('comments')->fetch();

    }

    /**
     * Get  Latest Posts
     * @return void
     */
    public function latest($number, $offset)
    {
        return $this->select('p.*', 'c.name AS `category`', 'u.first_name ', 'u.last_name')
                    ->select('(SELECT COUNT(co.id) FROM comments co WHERE co.post_id = p.id) AS total_comments')
                    ->from('posts p')
                    ->where('p.status = ?', 'enabled')
                    ->join('LEFT JOIN categories c ON p.category_id = c.id')
                    ->join('LEFT JOIN users u ON p.user_id = u.id')
                    ->orderBy('p.id', 'DESC')
                    ->limitAndOffset($number, $offset)
                    ->fetchAll();
    }

    /**
     * Get  Post With Comments
     * @param int $id
     * @return mixed
     */
    public function getPostWithComments($id)
    {
        $post =    $this->select('p.*', 'u.first_name ', 'u.last_name', 'u.image AS userImage')
                        ->from('posts p')
                        ->join('LEFT JOIN users u ON p.user_id = u.id')
                        ->where('p.id = ? AND p.status = ?', $id, 'enabled')
                        ->fetch();

        if(! $post) return null;

        $post->comments = $this->select('c.*', 'u.first_name ', 'u.last_name', 'u.image AS userImage')
                               ->from('comments c')
                               ->join('LEFT JOIN users u ON c.user_id = u.id')
                               ->where('c.post_id = ? ', $id)
                               ->fetchAll();
        return $post;
    }

    /**
     * Get  Post With Comments based on Search
     * @param string $query
     * @return mixed
     */
    public function getPostsSearched($query)
    {
         return $this->select('p.*', 'c.name AS `category`', 'u.first_name ', 'u.last_name')
                        ->select('(SELECT COUNT(co.id) FROM comments co WHERE co.post_id = p.id) AS total_comments')
                        ->from('posts p')
                        ->where('p.title LIKE ? AND p.status = ?', "%" . $query . "%", 'enabled')
                        ->join('LEFT JOIN categories c ON p.category_id = c.id')
                        ->join('LEFT JOIN users u ON p.user_id = u.id')
                        ->orderBy('p.id', 'DESC')
                        ->fetchAll();
    }


    /**
     * Get  Post With Comments based on Search
     * @param string $tags
     * @return mixed
     */
    public function getPostWithTags($tags)
    {
        return $this->select('p.*', 'c.name AS `category`', 'u.first_name ', 'u.last_name')
            ->select('(SELECT COUNT(co.id) FROM comments co WHERE co.post_id = p.id) AS total_comments')
            ->from('posts p')
            ->where('p.tags LIKE ? AND p.status = ?', "%" . $tags . "%", 'enabled')
            ->join('LEFT JOIN categories c ON p.category_id = c.id')
            ->join('LEFT JOIN users u ON p.user_id = u.id')
            ->orderBy('p.id', 'DESC')
            ->fetchAll();
    }


    /**
     * Create New Post Record
     * @return void
     */
    public function create()
    {
        // Upload Image and Move it to Given Folder
        $image = $this->imageUpload();
        if($image) {
            $this->data('image', $image);
        }
        $now = time();

        // Get User
        $user = $this->load->model('Login')->user();

        $this->data('title', $this->request->post('title'))
            ->data('details', $this->request->post('details'))
            ->data('category_id', $this->request->post('category'))
            ->data('user_id', $user->id)
            ->data('tags', $this->request->post('tags'))
            ->data('related_posts', implode(',', array_filter((array) $this->request->post('related_posts'), 'is_numeric')))
            ->data('status', $this->request->post('status'))
            ->data('created', $now)
            ->insert($this->table);
    }

    /**
     * Update Category
     *
     * @param int $id
     * @return void
     */
    public function update($id)
    {
        // Upload Image and Move it to Given Folder
        $image = $this->imageUpload();
        if($image) {
            $this->data('image', $image);
        }

        $this->data('title', $this->request->post('title'))
            ->data('details', $this->request->post('details'))
            ->data('category_id', $this->request->post('category'))
            ->data('tags', $this->request->post('tags'))
            ->data('related_posts', implode(',', array_filter((array) $this->request->post('related_posts'), 'is_numeric')))
            ->data('status', $this->request->post('status'))
            ->where('id = ? ' , $id)
            ->update($this->table);
    }

    //implode(',', array_filter((array) $this->request->post('related_posts'), 'is_numeric'))
    /**
     * Delete Record
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $this->where('id = ? ', $id)->delete($this->table);
    }


    /**
     * Add Comment
     * @param int $postId
     * @param int $userId
     * @return void
     */
    public function addComment($postId, $userId)
    {
        $now = time();
        $this->data('comment', $this->request->post('comment'))
             ->data('post_id', $postId)
             ->data('user_id', $userId)
             ->data('status', 'enabled')
             ->data('created', $now)
             ->insert('comments');
    }

}