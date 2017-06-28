<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 6/12/17
 * Time: 1:53 PM
 */

namespace App\Models;

use System\Model;

class ProfileModel  extends Model
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
     * Get Current User based on his user_name
     * @return void
     */
    public function profile()
    {
        $code = '';
        if(!is_null($this->cookie->get('user'))){
            $code = $this->cookie->get('user');
        } elseif(!is_null($this->session->get('user'))){
            $code = $this->session->get('user');
        }

        return $this->select('*')
            ->from('users')
            ->where('code = ? ', $code)
            ->fetch();

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

        // Check if User changed his password
        $password = $this->request->post('password');
        if($password) {
            $this->data('password', password_hash($this->request->post('password'), PASSWORD_DEFAULT));
        }

        $this->data('first_name', $this->request->post('first_name'))
            ->data('last_name', $this->request->post('last_name'))
            ->data('email', $this->request->post('email'))
            ->data('gender', $this->request->post('gender'))
            ->data('birthday', strtotime($this->request->post('birthday')))
            ->where('id = ? ' , $id)
            ->update($this->table);
    }

}