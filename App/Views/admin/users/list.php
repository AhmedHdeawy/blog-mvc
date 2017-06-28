<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="../#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box" id="users-list">
                    <div class="box-header with-border">
                        <h3 class="box-title">Users List</h3>
                        <button class="btn btn-danger pull-right open-popup" type="button" data-modal-target="#add-user-form" data-target="<?php echo url('/admin/users/add'); ?>">Add New User</button>
                    </div>

                    <?php if(isset( $success)) { ?>
                        <div class="alert alert-success">

                            <?php echo $success; ?>
                        </div>

                    <?php } ?>

                    <div id="result"></div>


                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Group</th>
                                <th>FirstName</th>
                                <th>LastName</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Image</th>
                                <th>BirthDate</th>
                                <th>Joined</th>
                                <th>Status</th>
                                <th>IP</th>
                            </tr>
                            <?php foreach ($users as $user) { ?>
                                <tr>

                                    <td><?php echo $user->id; ?></td>
                                    <td><?php echo $user->user_group_id; ?></td>
                                    <td><?php echo $user->first_name; ?></td>
                                    <td><?php echo $user->last_name; ?></td>
                                    <td><?php echo $user->email; ?></td>
                                    <td><?php echo $user->gender; ?></td>
                                    <td><img src="<?php echo assets('userImages/' . $user->image); ?>" style="width: 50px; height: 50px;"></td>
                                    <td><?php echo date('d-m-Y', $user->birthday); ?></td>
                                    <td><?php echo date('d-m-Y', $user->created); ?></td>
                                    <td><?php echo ucfirst($user->status); ?></td>
                                    <td><?php echo $user->ip; ?></td>

                                    <td>
                                        <a href="<?php echo url('admin/users/edit/' . $user->id); ?>" class="btn btn-primary">
                                            Edit <span class="fa fa-edit"></span>
                                        </a>


                                        <?php if($user->user_group_id != 1) { ?>
                                            <button data-target="<?php echo url('admin/users/delete/' . $user->id); ?>" class="btn btn-danger delete">
                                                Delete <span class="fa fa-edit"></span>
                                            </button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->