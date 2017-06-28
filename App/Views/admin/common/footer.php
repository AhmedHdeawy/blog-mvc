
<div class="modal fade" id="user-profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update User Profile</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo url('/admin/profile/update'); ?>" class="form form-modal" method="post">

                    <div id="form-result"></div>

                    <div class="form-group col-sm-6">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" value="<?php echo $user->first_name; ?>" class="form-control" id="first_name" placeholder="First Name">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" value="<?php echo $user->last_name; ?>" class="form-control" id="last_name" placeholder="Last Name">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="email">Email</label>
                        <input type="text" name="email" value="<?php echo $user->email; ?>" class="form-control" id="email" placeholder="Email">
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
                        <label for="gender">Sex</label>
                        <select name="gender" class="form-control" id="gender">
                            <option value="male">Male</option>
                            <option value="female" <?php echo $user->gender === 'female' ? 'selected' : false; ?>  >Female</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="birthday">BirthDate</label>
                        <input type="text" name="birthday" value="<?php echo date('Y-m-d', $user->birthday); ?>" class="form-control" id="birthday">
                    </div>

                    <div class="col-sm-6">

                        <img src="<?php echo assets('userImages/' . $user->image); ?>" class="img-responsive" style="width: 60px;">

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




<!-- jQuery 2.2.0 -->
<script src="<?php echo assets('admin/plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo assets('admin/plugins/jQueryUI/jquery-ui.min.js'); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo assets('admin/bootstrap/js/bootstrap.min.js'); ?>"></script>

<!-- CKeditor -->
<script src="<?php echo assets('admin/plugins/ckeditor/ckeditor.js'); ?>"></script>

<script src="<?php echo assets('admin/plugins/raphael/raphael.min.js'); ?>"></script>

<!-- Morris.js charts -->
<script src="<?php echo assets('admin/plugins/morris/morris.min.js'); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo assets('admin/plugins/sparkline/jquery.sparkline.min.js'); ?>"></script>
<!-- jvectormap -->
<script src="<?php echo assets('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>"></script>
<script src="<?php echo assets('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo assets('admin/plugins/knob/jquery.knob.js'); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo assets('admin/plugins/moment/moment.min.js'); ?>"></script>
<script src="<?php echo assets('admin/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
<!-- datepicker -->
<script src="<?php echo assets('admin/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo assets('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
<!-- Slimscroll -->
<script src="<?php echo assets('admin/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
<!-- FastClick -->
<script src="<?php echo assets('admin/plugins/fastclick/fastclick.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo assets('admin/dist/js/app.min.js'); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo assets('admin/dist/js/pages/dashboard.js'); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo assets('admin/dist/js/demo.js'); ?>"></script>


<script>


    // Adjusting Sidebar
    var currentUrl = window.location.href;
    var segment = currentUrl.split('/').pop();
    $('.sidebar-link').removeClass('active');
    $('#' + segment + '-link').addClass('active');
    

    $('.open-popup').on('click', function () {

    btn = $(this);

    url = btn.data('target');

    modalTarget = btn.data('modal-target');

    if($(modalTarget).length > 0)
    {
        $(modalTarget).modal('show');
    } else {


        $.ajax({

            url     : url,
            type    : 'POST',
            success : function (htmlResult) {

                $('body').append(htmlResult);

                $(modalTarget).modal('show');
            },

        });
    }


    // Add New Record using Ajax

    $(document).on('click', '.submit-btn', function (e) {

        e.preventDefault();

        var btn = $(this);

        var form = btn.parents('.form');

        // Get data from CKeditor
        if(form.find('#details').length) {
            form.find('#details').val(CKEDITOR.instances.details.getData());
        }

        var requestUrl = form.attr('action');

        var requestData = new FormData(form[0]);

        var requestMethod = form.attr('method');

        var formResult = $('form').find('#form-result');

        $.ajax({
            url       :   requestUrl,
            data      :   requestData,
            type      :   requestMethod,
            dataType  : ' json',
            beforeSend:   function () {

                formResult.removeClass().addClass('alert alert-info').html('Loading....');
            },
            success   :   function (results) {

                if(results.errors) {
                    // Errors will return in Array Formulate
                    formResult.removeClass().addClass('alert alert-danger').html(results.errors);
                }
                else if(results.success) {
                    // If Success
                    formResult.removeClass().addClass('alert alert-success').html(results.success);
                }

                if(results.redirectTo) {
                    window.location.href = results.redirectTo;
                }

            },
            cache: false,
            processData : false,
            contentType : false
        });


    });


});


$('.delete').on('click', function (e) {

    e.preventDefault();

    var decision = confirm("Are you sure ?!");

    if(decision === true) {

        // Start Deleting

        button = $(this);

        $.ajax({

            url: button.data('target'),
            type: 'POST',
                dataType: 'JSON',
            beforeSend: function () {

                $('#result').removeClass().addClass('alert alert-info').html('Deleting');
            },

            success: function (result) {

                if(result.success) {

                    $('#result').removeClass().addClass('alert alert-success').html('Deleted');

                    button.parents('tr').fadeOut(function () {
                        this.remove();
                    });

                }

            }

        });

    } else  {

        return false;
    }

});





</script>

</body>
</html>
