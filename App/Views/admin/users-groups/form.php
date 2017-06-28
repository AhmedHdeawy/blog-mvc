
<div class="modal fade" id="add-groups-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Users Groups</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo $action;?>" class="form form-modal" method="post">

                    <div id="form-result"></div>
                    <div class="form-group col-sm-12">
                        <label for="add-category">Group Name</label>
                        <input type="text" name="name" class="form-control" id="add-category" placeholder="Group Name">
                    </div>

                    <div class="form-group col-sm-12">

                        <label for="pages">Pages</label>
                        <select name="pages[]" id="pages" multiple="multiple" class="form-control">

                            <?php foreach ($pages AS $page){ ?>

                                <option value="<?php echo $page; ?>"><?php echo $page; ?></option>

                            <?php } ?>
                        </select>

                    </div>


                    <button class="btn btn-info submit-btn">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
