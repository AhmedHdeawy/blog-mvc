<?php

// White list routes

use System\Application;

$app = Application::getInstance();

// Routes =>  $app->route('link', 'Controller Name @ Method Name', 'POST or GET')


if(strpos($app->request->url(), '/admin') === 0) {

    // check if the current URL started with /admin
    // if so, then call our Middlewares

    $app->load->controller('Admin/Access')->index();


    // Common Admin Layout
    $app->share('adminLayout', function ($app){
        return $app->load->controller('Admin/Common/Layout');
    });
} else {

// Common Blog Layout
    $app->share('blogLayout', function ($app){
        return $app->load->controller('Blog/Common/Layout');
    });
}

/********************* Admin Routes **********************/




// Login
$app->route->add('/admin/login', 'Admin/Login');
$app->route->add('/admin/login/submit', 'Admin/Login@submit', 'POST');

// Dashboard
$app->route->add('/admin', 'Admin/Dashboard');
$app->route->add('/admin/dashboard', 'Admin/Dashboard');
$app->route->add('/admin/submit', 'Admin/Dashboard@submit', 'POST');

// Admin => User
$app->route->add('/admin/users', 'Admin/Users');
$app->route->add('/admin/users/add', 'Admin/Users@add', 'POST');
$app->route->add('/admin/users/submit', 'Admin/Users@submit', 'POST');
$app->route->add('/admin/users/edit/:id', 'Admin/Users@edit');
$app->route->add('/admin/users/save/:id', 'Admin/Users@save', 'POST');
$app->route->add('/admin/users/delete/:id', 'Admin/Users@delete', 'POST');

// Admin => Profile
$app->route->add('/admin/profile/update', 'Admin/Profile@update', 'POST');

// Admin => User Groups
$app->route->add('/admin/users-groups', 'Admin/UsersGroups');
$app->route->add('/admin/users-groups/add', 'Admin/UsersGroups@add', 'POST');
$app->route->add('/admin/users-groups/submit', 'Admin/UsersGroups@submit', 'POST');
$app->route->add('/admin/users-groups/edit/:id', 'Admin/UsersGroups@edit');
$app->route->add('/admin/users-groups/save/:id', 'Admin/UsersGroups@save', 'POST');
$app->route->add('/admin/users-groups/delete/:id', 'Admin/UsersGroups@delete', 'POST');


// Admin => Posts
$app->route->add('/admin/posts', 'Admin/Posts');
$app->route->add('/admin/posts/add', 'Admin/Posts@add', 'POST');
$app->route->add('/admin/posts/submit', 'Admin/Posts@submit', 'POST');
$app->route->add('/admin/posts/edit/:id', 'Admin/Posts@edit');
$app->route->add('/admin/posts/save/:id', 'Admin/Posts@save', 'POST');
$app->route->add('/admin/posts/delete/:id', 'Admin/Posts@delete', 'POST');

// Admin => Comments
$app->route->add('/admin/posts/:id/comments', 'Admin/Comments');
$app->route->add('/admin/comments/edit/:id', 'Admin/Comments@edit');
$app->route->add('/admin/comments/save/:id', 'Admin/Comments@save', 'POST');
$app->route->add('/admin/comments/delete/:id', 'Admin/Comments@delete');


// Admin => Categories
$app->route->add('/admin/categories', 'Admin/Categories');
$app->route->add('/admin/categories/add', 'Admin/Categories@add', 'POST');
$app->route->add('/admin/categories/submit', 'Admin/Categories@submit', 'POST');
$app->route->add('/admin/categories/edit/:id', 'Admin/Categories@edit');
$app->route->add('/admin/categories/save/:id', 'Admin/Categories@save', 'POST');
$app->route->add('/admin/categories/delete/:id', 'Admin/Categories@delete', 'POST');

// Admin => Settings
$app->route->add('/admin/settings', 'Admin/Settings');
$app->route->add('/admin/settings/add', 'Admin/Settings@add');
$app->route->add('/admin/settings/submit', 'Admin/Settings@submit', 'POST');
$app->route->add('/admin/settings/save', 'Admin/Settings@save', 'POST');


// Admin => Contacts
$app->route->add('/admin/contacts', 'Admin/Contacts');
$app->route->add('/admin/contacts/reply/:id', 'Admin/Contacts@reply');
$app->route->add('/admin/contacts/send/:id', 'Admin/Contacts@send', 'POST');

// Admin => Ads
$app->route->add('/admin/ads', 'Admin/Ads');
$app->route->add('/admin/ads/add', 'Admin/Ads@add');
$app->route->add('/admin/ads/submit', 'Admin/Ads@submit', 'POST');
$app->route->add('/admin/ads/edit:id', 'Admin/Ads@edit');
$app->route->add('/admin/ads/save:id', 'Admin/Ads@save', 'POST');
$app->route->add('/admin/ads/delete:id', 'Admin/Ads@delete');

// Logout
$app->route->add('/admin/logout', 'Admin/Logout');

// Not Found Routes

$app->route->add('/404', 'NotFound');
$app->route->notFound('/404');



/*================= Blog Routes ================*/

$app->route->add('/', 'Blog/Home');
$app->route->add('/category/:text/:id', 'Blog/Category@index');
$app->route->add('/post/:text/:id', 'Blog/Post');
$app->route->add('/post/:text/:id/-add-comment', 'Blog/Post@addComment', 'POST');
$app->route->add('/post/tag/:text/:id', 'Blog/Post@tags');
$app->route->add('/register', 'Blog/Register', 'POST');
$app->route->add('/register/add', 'Blog/Register@add', 'POST');
$app->route->add('/register/submit', 'Blog/Register@submit', 'POST');
$app->route->add('/login', 'Blog/Login');
$app->route->add('/login/submit', 'Blog/Login@submit', 'POST');
$app->route->add('/profile', 'Blog/Profile');
$app->route->add('/profile/edit/:id', 'Blog/Profile@save', 'POST');
$app->route->add('/profile/delete/:id', 'Blog/Profile@delete');
$app->route->add('/contact-us', 'Blog/Contact');
$app->route->add('/contact-us/submit', 'Blog/Contact@submit', 'POST');
$app->route->add('/about-us', 'Blog/About');
$app->route->add('/search', 'Blog/Search');
$app->route->add('/logout', 'Blog/Logout');

