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
                        <h3 class="box-title">Users Groups List</h3>
                        <button class="btn btn-danger pull-right open-popup" type="button" data-modal-target="#add-groups-form" data-target="<?php echo url('/admin/users-groups/add'); ?>">Add New User Group</button>
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

                                <th>Group Name</th>
<!--                                <th>Status</th>-->
                                <th>Action</th>

                            </tr>

                            <?php
                                foreach ($users_groups as $user_group) {
                            ?>

                               <tr>
                                   <td><?php echo $user_group->id; ?></td>
                                   <td><?php echo $user_group->name; ?></td>
<!--                                   <td>--><?php //echo ucfirst($category->status); ?><!--</td>-->
                                   <td>
                                       <a href="<?php echo url('admin/users-groups/edit/' . $user_group->id); ?>" class="btn btn-primary">
                                           Edit <span class="fa fa-edit"></span>
                                       </a>

                                       <?php if($user_group->id != 1) { ?>
                                       <button data-target="<?php echo url('admin/users-groups/delete/' . $user_group->id); ?>" class="btn btn-danger delete">
                                           Delete <span class="fa fa-edit"></span>
                                       </button>
                                       <?php } ?>
                                   </td>
                               </tr>

                            <?php } ?>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <!-- <ul class="pagination pagination-sm no-margin pull-right">
                          <li><a href="#">&laquo;</a></li>
                          <li><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">&raquo;</a></li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->