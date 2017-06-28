
        <div class="col-md-8">
            <div class="jumbotron jumbotron-sm col-sm-12">
                <div class="col-sm-12 col-lg-12">
                    <h1 class="h1">
                        Contact us <small>Feel free to contact us</small></h1>
                </div>
            </div>

            <?php if(isset( $success)) { ?>
                <div class="alert alert-success">

                    <?php echo $success; ?>
                </div>

            <?php } ?>

            <?php if(!empty($errors)) { ?>
                <div class="alert alert-danger">
                    <h4>Errors happens Send your Message: </h4>
                    <?php foreach ($errors as $error) {
                        echo $error . "<br/>";
                    } ?>
                </div>
            <?php }  ?>

            <!--    Contact Us Section        -->
            <div class="well well-sm">
                <form action="<?php echo url('/contact-us/submit'); ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" />
                            </div>

                            <div class="form-group">
                                <label for="name">
                                    Subject</label>
                                <input type="text" name="subject" class="form-control" id="name" placeholder="Enter Subject" />
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    Email Address</label>
                                <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" /></div>
                            </div>

                            <div class="form-group">
                                <label for="email">
                                    Phone Number</label>
                                <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span>
                                </span>
                                    <input type="text" name="phone" class="form-control" id="email" placeholder="Enter Your Phone number" /></div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    Message</label>
                                <textarea name="message" id="message" class="form-control" rows="13" cols="35" placeholder="Your Message must be at least 50 characters"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
                                Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
