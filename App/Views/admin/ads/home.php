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
<form action="<?php echo url('/admin/ads/submit'); ?>">

    <input type="text" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <input type="password" name="confirm_password" placeholder="Confirm">
    <input type="text" name="fullname" placeholder="Full Name">
    <input type="file" name="file">

    <button>Send</button>

    <br>

    <div class="form-ajax">

    </div>

</form>

</div>

<script src="<?php echo url('public/admin/plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>

<script>

    $('form').on('submit', function (e) {
        e.preventDefault();

        var form = $(this);

        var sendData = new FormData(form[0]);

        $.ajax({

            url : form.attr('action'),
            type : 'POST',
            data : sendData,
            dataType: 'json',
            success : function (r) {
                $('body').append(r.name);
            },
            cache : false,
            processData : false,
            contentType : false

        });

    })

</script>