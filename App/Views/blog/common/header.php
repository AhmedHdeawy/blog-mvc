<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Google Web Fonts
    ================================================== -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CSource+Sans+Pro:400,700" rel="stylesheet">

    <!-- CSS
    ================================================== -->
    <!-- Vendor CSS -->
    <link href="<?php echo assets('blog/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo assets('blog/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo assets('blog/css/jssocials-theme-classic.css'); ?>" rel="stylesheet">
    <link href="<?php echo assets('blog/css/jssocials.css'); ?>" rel="stylesheet">
    <link href="<?php echo assets('blog/css/style.css'); ?>" rel="stylesheet">

    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body>


<nav class="navbar navbar-default navbar-fixed-top another-navbar">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo url('/'); ?>">Blog</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="<?php echo url('/'); ?>">Home <span class="sr-only">(current)</span></a></li>
                <li><a href="<?php echo url('/contact-us'); ?>">Contact Us <?php //echo $user->email; ?></a></li>
                <?php if(!$user){ ?>
                    <li>
                        <button class="btn modal-home" href="#" data-toggle="modal" data-modal-target="#myModal" data-target="<?php echo url('/register/add'); ?>" >Login/Register</button>
                    </li>
                <?php } ?>

                <?php if($user) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><img src="<?php echo assets('userImages/' . $user->image); ?>" alt="" /> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo url('/profile'); ?>">Profile</a></li>
                            <?php if ($isAdmin === true) { ?>
                            <li><a href="<?php echo url('/admin'); ?>">Admin Panel</a></li>
                            <?php } ?>
                            <li><a href="<?php echo url('/logout'); ?>">Logout</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<!-- Modal / Start -->

<!-- Modal -->
<div class="modal fade modal-navbar" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">&Chi;</button>

                <div class="row">

                    <div class="btn-login">
                        <button type="button" class="btn log">Login</button>
                        <button type="button" class="btn reg">Register</button>
                    </div>

                </div>
                <div class="row">
                    <div class="login-form" id="modal-login">
                        <div class="heading5">
                            <h4>Login To your<span> Account</span></h4>
                        </div>
                        <form action="<?php echo url('/login/submit'); ?>" method="post" id="login-form">

                            <!--  Errors Section      -->
                            <div id="login-result" style="font-weight: bold"> </div>

                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email" id="email">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" id="pwd" placeholder="Password">
                            </div>

                            <div class="col-xs-8">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>

                            <div class="form-group pass-forget">
                                <a href="#" class="pull-right">Forgot your password?</a>
                            </div>
                            <div class="sbmt">
                                <button type="submit" class="btn btn-default btn-block">Login</button>
                            </div>

                        </form>
                    </div>

                    <div class="login-form" id="modal-register">

                        <div class="heading5">
                            <h4>Register<span> Now!</span></h4>
                        </div>
                        <form class="form" action="<?php echo url('/register/submit'); ?>" method="post" enctype="multipart/form-data">

                            <div id="form-result"></div>

                            <div class="form-group col-sm-6">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name">
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name">
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Email">
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password" >
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="gender">Sex</label>
                                <select name="gender" class="form-control" id="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="birthday">BirthDate</label>
                                <input type="text" name="birthday" class="form-control" id="birthday">
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>

                            <div class="col-sm-12">
                                <div class="g-recaptcha" data-sitekey="6LdpIicUAAAAAAN9yGvyRLWHOxeyluLFthDjKC8b"></div>
                            </div>

                            <div class="sbmt">
                                <button type="submit" class="btn btn-form btn-default btn-block">Register</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


<section class="under-nav">

    <div class="post-main">

        <div class="container">

            <div class="row">
