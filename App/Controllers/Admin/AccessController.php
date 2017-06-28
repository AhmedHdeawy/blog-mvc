<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 6/12/17
 * Time: 10:10 AM
 */

namespace App\Controllers\Admin;

use System\Database;
use System\Controller;

class AccessController extends Controller
{
    /**
     * check user Permissions to access Admin Pages
     *
     * @return void
     */
    public function index()
    {
        $loginModel = $this->load->model('Login');

        // Exception Some of Routes for access to it
        $ignorePages = ['/admin/login', '/admin/login/submit'];

        // Get Current Route [ Current link ]
        $currentPage = $this->request->url();

        //check if User login && check if he has permission to access this Route
        // if Not Logged && has not Permission, then redirect to Login Page
        if(! $loginModel->isLogged() AND ! in_array($currentPage, $ignorePages)) {

           return $this->url->redirectTo('/admin/login');
        }

        if($loginModel->isLogged()) {

            $user = $loginModel->user();


            $userGroupsModel = $this->load->model('UsersGroups');

            // Get Record Details contains Pages
            $userGroup = $userGroupsModel->get($user->user_group_id);

            // check if Current URL Exits in UserGroup Pages
            if(! in_array($currentPage, $userGroup->pages)) {

                //return $this->url->redirectTo('/404');
            }
        }
        // Call USER function from LoginModel Class

    }
}