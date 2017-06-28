
<div class="col-xs-12 col-sm-12 col-md-8" id="profile-page-container">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $user->first_name . " " . $user->last_name ?></h3>
        </div>
        <div class="panel-body">

            <?php if(isset( $success)) { ?>
                <div class="alert alert-success">

                    <?php echo $success; ?>
                </div>

            <?php } ?>

            <?php if(!empty($errors)) { ?>
                <div class="alert alert-danger">
                    <h4>Errors during Updating your profile: </h4>
                    <?php foreach ($errors as $error) {
                        echo $error . "<br/>";
                    } ?>
                </div>
            <?php }  ?>
            <div class="row">
            <!--   User Image   -->
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?php echo assets('userImages/' . $user->image); ?>" class="img-circle img-responsive"> </div>
                <div class=" col-md-9 col-lg-9 ">
                    <table class="table table-user-information">
                        <tbody>
                            <tr>
                                <td>First Name:</td>
                                <td><?php echo $user->first_name; ?></td>
                            </tr>
                            <tr>
                                <td>Last Name:</td>
                                <td><?php echo $user->last_name; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?php echo $user->email; ?></td>
                            </tr>
                            <tr>
                                <td>Joind:</td>
                                <td><?php echo date('d-m-Y', $user->created); ?></td>
                            </tr>
                            <tr>
                                <td>Date of Birth</td>
                                <td><?php echo date('d-m-Y', $user->birthday); ?></td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td><?php echo $user->gender; ?></td>
                            </tr>
                            <tr>
                                <td>Device IP</td>
                                <td><?php echo $user->ip; ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <button id="open-edit-form" class="btn btn-primary">Edit My Information</button>
                    <button data-target="<?php echo url('/profile/delete/' . $user->id); ?>" class="btn btn-danger delete">
                        Delete My Account <span class="fa fa-edit"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default" id="edit-form">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $user->first_name . " " . $user->last_name ?></h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <!--   User Image   -->
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?php echo assets('userImages/' . $user->image); ?>" class="img-circle img-responsive"> </div>
                <div class=" col-md-9 col-lg-9 ">
                    <table class="table table-user-information">
                        <tbody>

                            <form action="<?php echo url('/profile/edit/'. $user->id); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <input type="hidden" value="<?php echo $user->id; ?>">

                                <tr>
                                    <td>First Name:</td>
                                    <td><input type="text" name="first_name" value="<?php echo $user->first_name; ?>" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Last Name:</td>
                                    <td><input type="text" name="last_name" value="<?php echo $user->last_name; ?>" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input type="text" name="email" value="<?php echo $user->email; ?>" class="form-control"></td>
                                </tr>

                                <tr>
                                    <td>Password</td>
                                    <td><input type="password" name="password" class="form-control" id="password" ></td>

                                </tr>

                                <tr>
                                    <td>Confirm Password</td>
                                    <td><input type="password" name="confirm_password" class="form-control" id="confirm_password" ></td>

                                </tr>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td><input type="text" name="birthday" value="<?php echo date('d-m-Y', $user->birthday); ?>" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>
                                        <select name="gender" class="form-control" id="gender">
                                            <option value="male">Male</option>
                                            <option value="female" <?php echo $user->gender === 'female' ? 'selected' : false; ?>>Female</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Picture</td>
                                    <td><input type="file" name="image" class="form-control" id="image"></td>
                                </tr>
                                <tr>
                                    <td><button type="submit" class="btn btn-primary">Save New Information</button></td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                    <hr>
                    <br>
                    <button id="cancel-edit-form" class="btn btn-danger">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>