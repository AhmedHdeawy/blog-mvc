<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/24/17
 * Time: 9:33 PM
 */

namespace App\Controllers\Admin;

use System\Controller;

class AdsController extends Controller
{
    public function index()
    {
        $this->html->setTitle('Adsense');

        $view = $this->view->render('admin/ads/home');

        return $this->adminLayout->render($view);
    }

    public function submit()
    {

        $json['name'] = $this->request->post('fullname');
        return json_encode($json);

        $this->validator->required('email')->email('email')->unique('email', ['users', 'email']);
        $this->validator->minLen('password', 8);
        $this->validator->match('password', 'confirm_password');

        $file = $this->request->file('file');

        if($file->isImage()) {
            $file->move($this->file->to('public/images'));
        }

    }

}