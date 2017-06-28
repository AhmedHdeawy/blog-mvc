<!--footer start from here-->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 footer-col">
                <div class="logofooter"> <?php echo $site_name; ?></div>
                <p><?php echo $site_about; ?></p>
                <p><i class="fa fa-map-marker"></i><?php echo $site_map; ?></p>
                <p><i class="fa fa-phone"></i> Phone (Egypt) : <?php echo $site_phone; ?></p>
                <p><i class="fa fa-envelope"></i> E-mail : <?php echo $site_email; ?></p>

            </div>

            <div class="col-md-5 col-sm-6 footer-col">
                <h6 class="heading7">LATEST POST</h6>
                <div class="post">
                    <?php foreach ($posts as $post){ ?>
                    <p>
                        <a href="<?php echo url('/post/' . seo($post->title) . '/' . $post->id); ?>"><?php echo $post->title;?></a>
                        <span><?php echo date('d-m-Y', $post->created);?></span>
                    </p>
                    <?php } ?>

                </div>
            </div>
            <div class="col-md-3 col-sm-6 footer-col">
                <h6 class="heading7">Social Media</h6>
                <ul class="footer-social">
                    <li><a href="<?php echo $linkedin; ?>" target="_blank"><i class="fa fa-linkedin social-icon linked-in" aria-hidden="true"></i></a></li>
                    <li><a href="<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook social-icon facebook" aria-hidden="true"></i></a></li>
                    <li><a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter social-icon twitter" aria-hidden="true"></i></a></li>
                    <li><a href="<?php echo $google; ?>" target="_blank"><i class="fa fa-google-plus social-icon google" aria-hidden="true"></i></a></li>
                    <li><a href="<?php echo $youtube; ?>" target="_blank"><i class="fa fa-youtube social-icon youtube" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!--footer start from here-->

<div class="copyright">
    <div class="container">
        <div class="col-md-12 text-center">
            <p><?php echo date('Y', time());?> - All Rights Reserved ©  <?php echo $site_name; ?></p>
        </div>

    </div>
</div>




<script type="text/javascript" src="<?php echo assets('blog/js/jquery-1.12.0.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo assets('blog/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo assets('blog/js/main.js'); ?>"></script>
<script type="text/javascript" src="<?php echo assets('blog/js/jssocials.min.js'); ?>"></script>

<!-- Cosial Sharing -->
<script>

    $("#sharePopup").jsSocials({
        shareIn: "popup",
        url: $(this).parent('.panel-footer').prevAll('.panel-heading').children('h3.panel-title').text(),
        text: document.getElementsByTagName("title")[0].innerHTML,
        showCount: true,
        showLabel: true,
        shares: [
            { share: "twitter", via: "artem_tabalin", hashtags: "search,google" },
            "facebook",
            "googleplus",
            "linkedin",
        ]
    });

</script>

<script>

    $('#edit-form').fadeOut(0);

    $('#open-edit-form').on('click', function () {
        $('#edit-form').fadeIn(100);
    });

    $('#cancel-edit-form').on('click', function () {
        $('#edit-form').fadeOut(200);
    });

</script>

<script>

    $('.modal-home').on('click', function () {

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

        $(document).on('click', '.btn-form', function (e) {

            e.preventDefault();

            var btn = $(this);

            var form = btn.parents('.form');

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

</script>

<script>
        // Login with Ajax
        $('#login-form').on('submit', function (e) {

            var flag = false;
            var loginResult = $('#login-result');

            e.preventDefault();

            if(flag === true) {
                return false;
            }

            // get Form
            form = $(this);

            requestUrl = form.attr('action');

            requestMethod = form.attr('method');

            requestData = form.serialize();

            $.ajax({
                url       :   requestUrl,
                type      :   requestMethod,
                data      :   requestData,
                dataType  : ' json',
                beforeSend:   function () {
                    flag = true;
                    $('button').attr('disabled', true);
                    loginResult.removeClass().addClass('alert alert-info').html('Logging...');

                },
                success   :   function (results) {

                    if(results.errors) {
                        loginResult.removeClass().addClass('alert alert-danger').html(results.errors);
                        $('button').attr('disabled', false);
                        flag = false;

                    } else if(results.success) {

                        loginResult.removeClass().addClass('alert alert-success').html(results.success);
                        if(results.redirect) {
                            window.location.href = results.redirect;
                        }
                    }

                }
            })


        })
</script>

<!-- Ajax for Add Comment -->

<!--<script>-->
<!---->
<!--    $('#add-comment').on('submit', function (e) {-->
<!---->
<!--        var flag = false;-->
<!--        var commentResult = $('#comment-result');-->
<!---->
<!--        e.preventDefault();-->
<!---->
<!--        if(flag === true) {-->
<!--            return false;-->
<!--        }-->
<!---->
<!--        form = $(this);-->
<!--        requestUrl = form.attr('action');-->
<!--        requestMethod = form.attr('method');-->
<!--        requestData = form.serialize();-->
<!---->
<!--        $.ajax({-->
<!---->
<!--            url : requestUrl,-->
<!--            type: requestMethod,-->
<!--            data: requestData,-->
<!--            dataType: 'JSON',-->
<!--            beforeSend: function () {-->
<!--                flag = true;-->
<!--                $('button').attr('disabled', true);-->
<!--                commentResult.removeClass().addClass('alert alert-info').html('Commenting...');-->
<!--            },-->
<!--            success: function (result) {-->
<!--                if(results.errors) {-->
<!--                    commentResult.removeClass().addClass('alert alert-danger').html(results.errors);-->
<!--                    //$('button').attr('disabled', false);-->
<!--                    flag = false;-->
<!---->
<!--                } else if(results.success) {-->
<!---->
<!--                    commentResult.removeClass().addClass('alert alert-success').html(results.success);-->
<!--                    if(results.redirect) {-->
<!--                        window.location.href = results.redirect;-->
<!--                    }-->
<!--                }-->
<!--            }-->
<!--        });-->
<!---->
<!--    })-->
<!---->
<!--</script>-->

<script>

    $('.delete').on('click', function (e) {

        e.preventDefault();

        var decision = confirm("Are you sure ?!");

        if(decision === true) {

            button = $(this);
            // Start Deleting
            var url = button.data('target');
            window.location.href = url;
            //console.log(url);

        } else  {

            return false;
        }

    });
</script>