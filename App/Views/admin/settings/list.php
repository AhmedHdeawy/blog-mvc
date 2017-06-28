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
                        <h3 class="box-title"><i class="fa fa-cog" aria-hidden="true"></i> Settings </h3>
                        <a href="<?php echo url('admin/settings/add'); ?>" class="btn btn-danger pull-right">
                            Add New  <span class="fa fa-plus"></span>
                        </a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <?php if(isset( $success)) { ?>
                            <div class="alert alert-success">

                                <?php echo $success; ?>
                            </div>

                        <?php } ?>

                        <form action="<?php echo $action; ?>" method="post" class="form-horizontal">

                            <?php foreach ($settings as $setting){ ?>

                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4> <label for="value"><?php echo $setting->key; ?> </label> </h4>
                                    </div>
                                    <div class="panel-body">
                                        <input type="text" name="value" value="<?php echo $setting->value; ?>" class="form-control" id="value" placeholder="Key Name">
                                    </div>

                                </div>

                            <?php } ?>

                            <div class="clearfix"></div>
                            <div class="col-sm-6">
                                <button class="btn btn-primary">Save</button>
                            </div>

                        </form>



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