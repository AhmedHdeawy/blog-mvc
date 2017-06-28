
<div class="modal fade" id="add-user-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New User</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo $action; ?>" class="form form-modal" method="post">

                    <div id="form-result"></div>

                    <div class="form-group col-sm-6">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="Email">
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
                                <option value="<?php echo $group->id; ?>"><?php echo $group->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="gender">Sex</label>
                        <select name="gender" class="form-control" id="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="birthday">BirthDate</label>
                        <input type="text" name="birthday" class="form-control" id="birthday">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="enabled">Enabled</option>
                            <option value="disabled">Disabled</option>
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
