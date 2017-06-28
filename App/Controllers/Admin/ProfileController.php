<?php

namespace App\Controllers\Admin;
use System\Database;

use \System\Controller;

class ProfileController extends Controller
{
    /**
     * Display Users Main Design
     *
     * @return mixed
     */








    /**
     * Save for Update users-groups
     *
     * @param int $id
     * @return string
     */
    public function update()
    {
        $user = $this->load->model('Login')->user();

        if($this->isValid($user->id)) {

            // There are no errors in Form

            $this->load->model('Profile')->update($user->id);

            $json['success'] = 'Your Profile has been Updated';

            $json['redirectTo'] = $this->request->referer() ?: $this->url->link('/admin/users');

        } else {

            $json['errors'] = $this->validator->flattenMessage();
        }

        return json_encode($json);
    }


    /**
     * Validate The Form
     *
     * @param int $id
     * @return bool
     */
    private function isValid($id = null)
    {
        $this->validator->required('first_name', 'First Name is Required');
        $this->validator->required('last_name', 'Last Name is Required');
        $this->validator->required('email', 'Email is Required');

        if(is_null($id)) {
            // if ID is null, then this is [ Create Process ], Validation Required
            // if NOT, then this is [ Update Process ], Validation Optionally
            $this->validator->required('password')->minLen('password', 8)->match('password', 'confirm_password');

            $this->validator->requiredFile('image')->image('image');
        } else {
            $this->validator->image('image');
        }

        return $this->validator->passes();
    }

}