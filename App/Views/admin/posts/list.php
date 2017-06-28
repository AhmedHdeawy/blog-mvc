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
                        <h3 class="box-title">Posts List</h3>
                        <button class="btn btn-danger pull-right open-popup" type="button" data-modal-target="#add-post-form" data-target="<?php echo url('/admin/posts/add'); ?>">Add New Posts</button>
                    </div>
                    <!-- /.box-header -->


                    <?php if(isset( $success)) { ?>
                        <div class="alert alert-success">

                            <?php echo $success; ?>
                        </div>

                    <?php } ?>

                    <div id="result"></div>

                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>User</th>
                                <th>Category</th>
                                <th>Details</th>
                                <th>Image</th>
                                <th>Tags</th>
                                <th>related_posts</th>
                                <th>Status</th>
                            </tr>
                            <?php foreach ($posts as $post) { ?>
                                <tr>

                                    <td><?php echo $post->id; ?></td>
                                    <td><?php echo $post->title; ?></td>
                                    <td><?php echo $post->first_name . $post->last_name; ?></td>
                                    <td><?php echo $post->category; ?></td>
                                    <td><?php echo read_more(html_entity_decode($post->details), 10); ?></td>
                                    <td><img src="<?php echo assets('postImages/' . $post->image); ?>" style="width: 50px; height: 50px"></td>
                                    <td><?php echo $post->tags; ?></td>
                                    <td><?php echo $post->related_posts; ?>
                                    </td>
                                    <td><?php echo ucfirst($post->status); ?></td>

                                    <td>
                                        <a href="<?php echo url('admin/posts/edit/' . $post->id); ?>" class="btn btn-primary">
                                            Edit <span class="fa fa-edit"></span>
                                        </a>
                                        <button data-target="<?php echo url('admin/posts/delete/' . $post->id); ?>" class="btn btn-danger delete">
                                            Delete <span class="fa fa-edit"></span>
                                        </button>
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