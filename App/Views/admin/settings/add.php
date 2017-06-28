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
                        <h3 class="box-title">Add New Settings</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <form action="<?php echo $action; ?>" method="post" class="form-horizontal">

                            <div class="form-group col-sm-12">
                                <label for="key">Key</label>
                                <input type="text" name="key" class="form-control" id="key" placeholder="Key Name">
                            </div>

                            <div class="form-group col-sm-12">

                                <label for="value">Value</label>
                                <input type="text" name="value" class="form-control" id="value" placeholder="Value">
                            </div>

                            <div class="clearfix"></div>
                            <div class="col-sm-6">
                                <button class="btn btn-primary">Add</button>
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