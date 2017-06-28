<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 6/12/17
 * Time: 1:53 PM
 */

namespace App\Models;

use System\Model;

class UsersModel  extends Model
{


    /**
     * Table Name
     * @var string
     */
    protected $table = 'users';


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

        return $image->move($this->app->file->toPublic('userImages'));
    }

    /**
     * Get All Users
     * @return void
     */
    public function all()
    {
        return $this->select('u.*, ug.name AS `group` ')
                      ->from('users u')
                      ->join('LEFT JOIN users_group ug ON u.user_group_id = ug.id')
                      ->fetchAll();

    }

    /**
     * Get Number of rows in Table
     * @return int
     */
    public function count()
    {
        return $this->select('COUNT(id) AS total')->from('users')->fetch();

    }

    /**
     * Get CurrentUser based on his Session
     * @return \stdClass $user
     */
    public function getUser()
    {
        $code = '';
        // If This User has  Cookie, Then Get its value
        if($this->cookie->has('user')) {

            $code = $this->cookie->get('user');

        } elseif ($this->session->has('user')) {

            $code = $this->session->get('user');
        }

        // Compare This [ Code ] With [ Code ] in DB
        return $this->where('code = ?', $code)->fetch($this->table);

    }

    /**
     * Get Permissions from UserGroup Table
     *
     * @return void
     */
    public function userGroups()
    {
        return $this->select('*')->from('users_group')->fetchAll();
    }

    /**
     * Create New Category Record
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

        $this->data('first_name', $this->request->post('first_name'))
             ->data('last_name', $this->request->post('last_name'))
             ->data('user_group_id', $this->request->post('group'))
             ->data('email', $this->request->post('email'))
             ->data('password', password_hash($this->request->post('password'), PASSWORD_DEFAULT))
             ->data('gender', $this->request->post('gender'))
             ->data('birthday', strtotime($this->request->post('birthday')))
             ->data('status', $this->request->post('status'))
             ->data('created', $now)
             ->data('code', sha1($now.mt_rand()))
             ->data('ip', $this->request->server('REMOTE_ADDR'))
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
        $now = time();

        // Upload Image and Move it to Given Folder
        $image = $this->imageUpload();
        if($image) {
            $this->data('image', $image);
        }

        // Check if User changed his password
        $password = $this->request->post('password');
        if($password) {
            $this->data('password', password_hash($this->request->post('password'), PASSWORD_DEFAULT));
        }

        $this->data('first_name', $this->request->post('first_name'))
            ->data('last_name', $this->request->post('last_name'))
            ->data('user_group_id', $this->request->post('group'))
            ->data('email', $this->request->post('email'))
            ->data('gender', $this->request->post('gender'))
            ->data('birthday', strtotime($this->request->post('birthday')))
            ->data('status', $this->request->post('status'))
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
        $this->where('id = ? ', $id)->delete($this->table);
    }


}