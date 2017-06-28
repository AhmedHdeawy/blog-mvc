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
                        <h3 class="box-title">Edit <?php echo $posts->title; ?></h3>
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

                        <form action="<?php echo url('admin/posts/save/' . $posts->id); ?>" method="post" enctype="multipart/form-data">

                            <div class="form-group col-sm-6">
                                <label for="title">Title</label>
                                <input type="text" name="title" value="<?php echo $posts->title; ?>" class="form-control" id="title" placeholder="Title">
                            </div>


                            <div class="form-group col-sm-12">
                                <label for="details">Details</label>
                                <textarea name="details" class="form-control" id="details">
                                    <?php echo $posts->details; ?>
                                </textarea>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="tags">Tags</label>
                                <input type="text" name="tags" value="<?php echo $posts->tags; ?>" class="form-control" id="tags" placeholder="Tags">
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="enabled">Enabled</option>
                                    <option value="disabled" <?php echo $posts->status === 'disabled' ? 'selected' : false; ?> >Disabled</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="category">Category</label>
                                <select class="form-control" name="category" id="category">
                                    <?php foreach ($categories AS $category) { ?>
                                        <option value="<?php echo $category->id; ?>" <?php echo $category->id === $posts->category_id ? 'selected' : false; ?>><?php echo $category->name; ?></option>
                                    <?php  } ?>
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="related_posts[]">Related</label>
                                <select class="form-control" multiple="multiple" name="related_posts[]" id="related_posts">
                                    <?php foreach ($related_posts AS $related_post)
                                    {
                                        if($related_post->id == $posts->id) continue;
                                        ?>
                                        <option value="<?php echo $related_post->id; ?>" ><?php echo $related_post->title; ?></option>
                                    <?php  } ?>
                                </select>
                            </div>


                            <div class="form-group col-sm-6">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>
                            <div class="col-sm-6">
                                
                                <img src="<?php echo assets('postImages/' . $posts->image); ?>" class="img-responsive" style="width: 60px;">
                                
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


<script>
    CKEDITOR.instances.details.destroy();
    CKEDITOR.replace('details')
</script>