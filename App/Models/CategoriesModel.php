<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 6/1/17
 * Time: 5:11 PM
 */

namespace App\Models;

use System\Model;

class CategoriesModel extends Model
{


    /**
     * Tabe Name
     * @var string
     */
    protected $table = 'categories';

    /**
     * Get All Categories
     * @return void
     */
    public function all()
    {
        return $this->select('*')->from($this->table)->fetchAll();
    }

    /**
     * Get Number of rows in Table
     * @return int
     */
    public function count()
    {
        return $this->select('COUNT(id) AS total')->from('categories')->fetch();

    }

    /**
     * Get all Enabled Categories which have number of posts larger than zero
     *
     * @return array
     */
    public function getEnabledCategoriesWithNumberOfPosts()
    {
        if(! $this->app->isSharing('enabled-categories')) {
            $categories  =  $this->select('c.id', 'c.name')
                ->select('(SELECT COUNT(p.id) FROM posts p WHERE p.status = "enabled" AND p.category_id = c.id) AS total_posts')
                ->from('categories c')
                ->where('c.status = ?', 'enabled')
                ->having('total_posts > 0')
                ->fetchAll();

            $this->app->share('enabled-categories', $categories);

        }

        return $this->app->get('enabled-categories');
    }

    /**
     *  Get Posts based on his category
     * @param int $id
     * @return array
     */
    public function getCategoryWithPosts($id)
    {
        $category = $this->where('id = ? AND status = ? ', $id, 'enabled')->fetch($this->table);

        if(!$category) return [];

        /**
         * Pagination Class Processes
         */
        // we will get current Page
        $currentPage = $this->pagination->getPage();
        // get Item per page
        $limit = $this->pagination->getItemsPrePage();


        $offset = $limit * ( $currentPage - 1 );

        $category->posts = $this->select('p.*', 'u.first_name ', 'u.last_name')
                                ->select('(SELECT COUNT(co.id) FROM comments co WHERE co.post_id = p.id) AS total_comments')
                                ->from('posts p')
                                ->join('LEFT JOIN users u ON p.user_id = u.id')
                                ->where('p.category_id = ? AND p.status = ? ', $id, 'enabled')
                                ->orderBy('p.id', 'DESC')
                                ->limitAndOffset($limit, $offset)
                                ->fetchAll();

        $totalPosts =  $this->select('COUNT(id) AS `total`')
                            ->from('posts')
                            ->where('category_id = ? AND status = ? ', $id, 'enabled')
                            ->orderBy('id', 'DESC')
                            ->fetch();
        if($totalPosts) {
            $this->pagination->setTotalItems($totalPosts->total);
        }
//        pre($category);
//        die();

        return $category;
    }

    /**
     * Create New Category Record
     * @return void
     */
    public function create()
    {
        $this->db->data('name', $this->request->post('name'))->data('status', $this->request->post('status'))->insert($this->table);
    }

    /**
     * Update Category
     *
     * @param int $id
     * @return void
     */
    public function update($id)
    {
        $this->db->data('name', $this->request->post('name'))->data('status', $this->request->post('status'))
            ->where('id = ? ' , $id)
            ->update($this->table);
    }

    /**
     * Delete Record
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $this->db->where('id = ? ', $id)->delete($this->table);
    }

}