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
                        <h3 class="box-title">Edit <?php echo $users_groups->name; ?></h3>
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

                        <form action="<?php echo url('admin/users-groups/save/' . $users_groups->id); ?>" method="post" enctype="multipart/form-data">

                            <div id="form-result"></div>
                            <div class="form-group col-sm-6">
                                <label for="add-category">Group Name</label>
                                <input type="text" name="name" value="<?php echo $users_groups->name; ?>" class="form-control" id="add-category" placeholder="Group Name">
                            </div>

                            <div class="form-group col-sm-12">

                                <label for="pages">Pages</label>
                                <select name="pages[]" id="pages" multiple="multiple" class="form-control">

                                    <?php foreach ($pages AS $page){ ?>

                                        <option value="<?php echo $page ?>" <?php echo in_array($page, $users_group_pages) ? 'selected' : false; ?> > <?php echo $page ?></option>

                                    <?php } ?>
                                </select>

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