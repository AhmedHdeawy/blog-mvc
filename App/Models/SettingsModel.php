<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 6/12/17
 * Time: 1:53 PM
 */

namespace App\Models;

use System\Model;

class SettingsModel  extends Model
{


    /**
     * Table Name
     * @var string
     */
    protected $table = 'settings';




    /**
     * Get All Settings
     * @return void
     */
    public function all()
    {
        return $this->select('*')
                    ->from($this->table)
                    ->fetchAll();
    }

    /**
     * Get Current Setting
     * @param string $key
     * @return void
     */
    public function get($key)
    {
        return $this->select('value')
            ->from($this->table)
            ->where('`key` = ? ', $key)
            ->fetch();
    }

    /**
     * Create New Settings
     */
    public function create()
    {
        $this->data('key', $this->request->post('key'))
             ->data('value', $this->request->post('value'))
             ->insert($this->table);
    }

}