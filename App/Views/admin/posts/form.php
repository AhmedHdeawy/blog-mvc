
<div class="modal fade" id="add-post-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Post</h4>
            </div>
            <div class="modal-body" style="overflow: hidden">
                <form action="<?php echo $action; ?>" class="form form-modal" method="post">

                    <div id="form-result"></div>

                    <div class="form-group col-sm-6">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                    </div>

                    <div class="form-group col-sm-12">
                        <label for="details">Details</label>
                        <textarea name="details" class="form-control" id="details"></textarea>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="tags">Tags</label>
                        <input type="text" name="tags" class="form-control" id="tags" placeholder="Tags">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="enabled">Enabled</option>
                            <option value="disabled">Disabled</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="category">Category</label>
                        <select class="form-control" name="category" id="category">
                            <?php foreach ($categories AS $category) { ?>
                                <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                            <?php  } ?>
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="related_posts">Related</label>
                        <select class="form-control" name="related_posts[]" multiple="multiple" id="related_posts">
                            <?php foreach ($posts AS $post) { ?>
                                <option value="<?php echo $post->id; ?>"><?php echo $post->title; ?></option>
                            <?php  } ?>
                        </select>
                    </div>


                    <div class="form-group col-sm-6">
                        <label for="image">Image</label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>

                    <div class="col-sm-12">
                        <button type="button" class="btn btn-info submit-btn">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script async="async">
    CKEDITOR.replace('details')
</script>
