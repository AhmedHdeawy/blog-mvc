<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/admin'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo url('/admin/categories'); ?>"><i class="fa fa-folder"></i> Category</a></li>
            <li><i class="active"></i> Update Category</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box" id="users-list">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit <?php echo $users->first_name; ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <?php if(!empty($errors)) { ?>
                            <div class="alert alert-danger">
                                <?php foreach ($errors as $error) {
                                    echo $error . "<br/>";
                                } ?>
                            </div>
                        <?php }  ?>

                        <form action="<?php echo url('admin/users/save/' . $users->id); ?>" method="post" enctype="multipart/form-data">

                            <div class="form-group col-sm-6">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" value="<?php echo $users->first_name; ?>" class="form-control" id="first_name" placeholder="First Name">
                                <?php if(! empty($errors['name'])) { ?>
                                    <div style="color: red"><?php echo $errors['name']; ?></div>
                                <?php } ?>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" value="<?php echo $users->last_name; ?>" class="form-control" id="last_name" placeholder="Last Name">
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="email">Email</label>
                                <input type="text" name="email" value="<?php echo $users->email; ?>" class="form-control" id="email" placeholder="Email">
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
                                <label for="group">UserGroup</label>
                                <select name="group" class="form-control" id="group">
                                    <?php foreach ($users_group as $group){ ?>
                                        <option value="<?php echo $group->id; ?>" <?php echo $group->id === $users->user_group_id ? "selected" : false; ?>><?php echo $group->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="gender">Sex</label>
                                <select name="gender" class="form-control" id="gender">
                                    <option value="male"> Male </option>
                                    <option value="female" <?php echo $users->gender === 'female' ? 'selected' : false; ?> >Female</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="birthday">BirthDate</label>
                                <input type="text" name="birthday" value="<?php echo date('d-m-Y', $users->birthday); ?>" class="form-control" id="birthday">
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="enabled" >Enabled</option>
                                    <option value="disabled" <?php echo $users->status === 'disabled' ? 'selected' : false; ?> >Disabled</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>
                            <div class="col-sm-6">
                                
                                <img src="<?php echo assets('userImages/' . $users->image); ?>" class="img-responsive" style="width: 60px;">
                                
                            </div>


                            <div class="clearfix"></div>
                            <div class="col-sm-6">
                                <button class="btn btn-info">Submit</button>
                            </div>

                        </form>
                        
                    </div>
                    
                </div>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->