<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/24/17
 * Time: 4:27 AM
 */

namespace App\Controllers\Blog\Common;

use System\Controller;

class FooterController extends Controller
{

    /**
     * Display Login Form
     *
     * @return mixed
     */
    public function index()
    {
        $data['site_name'] = $this->load->model('Settings')->get('Site_Name')->value;
        $data['owner'] = $this->load->model('Settings')->get('Site_Owner')->value;
        $data['site_about'] = $this->load->model('Settings')->get('Site_Info')->value;
        $data['site_map'] = $this->load->model('Settings')->get('Site_Map')->value;
        $data['site_phone'] = $this->load->model('Settings')->get('Site_Phone')->value;
        $data['site_email'] = $this->load->model('Settings')->get('Site_Email')->value;
        $data['facebook'] = $this->load->model('Settings')->get('Facebook')->value;
        $data['twitter'] = $this->load->model('Settings')->get('Twitter')->value;
        $data['google'] = $this->load->model('Settings')->get('Google')->value;
        $data['youtube'] = $this->load->model('Settings')->get('Youtube')->value;
        $data['linkedin'] = $this->load->model('Settings')->get('Linked_In')->value;


        $data['posts'] = $this->load->model("Posts")->latest(4, 8);

        return $this->view->render('blog/common/footer', $data);
    }
}