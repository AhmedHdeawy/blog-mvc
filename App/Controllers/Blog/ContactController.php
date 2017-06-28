<?php

namespace App\Controllers\Blog;
use System\Database;

use \System\Controller;

class ContactController extends Controller
{
    /**
     * Display Contact Us Page Main Design
     *
     * @return mixed
     */
    public function index()
    {
        $this->html->setTitle('Contact-Us');

        // If User Logged Continue to display Profile Page and Details
        $data['user'] = $this->load->model('Profile')->profile();

        $data['success'] = $this->session->has('done') ? $this->session->pull('done') : null;
        $data['errors'] = $this->session->has('failed') ? $this->session->pull('failed') : null;

        // Calling Index View [ list ]  and Passing Data to it
        // Notice: $data['categories'] is an Object NOT Array, it means that we will calling column as $category->id, $category->name
        $view = $this->view->render('blog/contact-us', $data);

        return $this->blogLayout->render($view);

    }

    /**
     * Save for Update users-groups
     * @return string
     */
    public function submit()
    {
        if($this->isValid()) {

            // There are no errors in Form

            $this->load->model('Contact')->create();

            $this->session->set('done', 'Your Message has been sent, we will send our reply on your mail, please check your email later');

            return $this->url->redirectTo('contact-us');

        } else {
            // we have an errors in Form
            // Get the Errors through getMessage Function
            $this->session->set('failed', $this->validator->getMessage());

            return $this->url->redirectTo('contact-us');
        }

    }

    /**
     * Validate The Form
     *
     * @return bool
     */
    private function isValid()
    {
        $this->validator->required('name', 'Name is Required');
        $this->validator->required('subject', 'Subject is Required');
        $this->validator->required('phone', 'Phone is Required');
        $this->validator->required('message', 'Message is Required')->minLen('message', 50, 'Please type Nice Message');
        $this->validator->required('email', 'Email is Required')->email('email', 'Enter Correct Email');

        return $this->validator->passes();
    }

}