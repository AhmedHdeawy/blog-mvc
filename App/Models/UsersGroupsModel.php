<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 6/12/17
 * Time: 1:53 PM
 */

namespace App\Models;

use System\Model;

class UsersGroupsModel  extends Model
{


    /**
     * Table Name
     * @var string
     */
    protected $table = 'users_group';

    /**
     * Get All Users Groups
     * @return void
     */
    public function all()
    {
        return $this->select('*')->from($this->table)->fetchAll();
    }

    /**
     * Get Users Group
     *
     * @param int $id
     * @return mixed
     */
    public function get($id)
    {
        $usersGroup =  parent::get($id);

        if($usersGroup) {

            $pages = $this->select('page')->where('user_group_id = ? ', $usersGroup->id)->fetchAll('users_group_permissions');

            $usersGroup->pages = [];

            if($pages) {

                foreach ($pages AS $page) {
                    $usersGroup->pages[] = $page->page;
                }
            }
        }

        return $usersGroup;
    }


    /**
     * Create New users_group Record
     * @return void
     */
    public function create()
    {
        $usersGroupId = $this->data('name', $this->request->post('name'))
                             ->insert($this->table)->lastid();

        // Remove any empty values form array
        $pages = array_filter($this->request->post('pages'));

        foreach ($pages AS $page) {

            $this->data('user_group_id', $usersGroupId)
                ->data('page', $page)
                ->insert('users_group_permissions');
        }

    }

    /**
     * Update users_group
     *
     * @param int $id
     * @return void
     */
    public function update($id)
    {
        $this->db->data('name', $this->request->post('name'))
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