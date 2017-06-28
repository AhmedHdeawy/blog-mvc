<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 6/12/17
 * Time: 1:53 PM
 */

namespace App\Models;

use System\Model;

class ContactModel  extends Model
{


    /**
     * Table Name
     * @var string
     */
    protected $table = 'contacts';


    /**
     * Update Category
     * @return void
     */
    public function create()
    {

        $this->data('name', $this->request->post('name'))
             ->data('subject', $this->request->post('subject'))
             ->data('email', $this->request->post('email'))
             ->data('phone', $this->request->post('phone'))
             ->data('message', $this->request->post('message'))
             ->data('created', time())
             ->insert($this->table);
    }

}