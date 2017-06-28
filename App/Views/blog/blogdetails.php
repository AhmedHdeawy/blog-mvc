
<section class="col-md-8 article-page">

                    <div class="article-body">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <?php  echo $post->title; ?>
                                </h3>
                            </div>
                            <div class="panel-body">
                                <p>
                                    <img class="img-responsive" src="<?php  echo assets('postImages/' . $post->image); ?>" alt="Image">
                                    <?php echo htmlspecialchars_decode($post->details); ?>
                                </p>
                            </div>

                            <!--   Footer for Display Tags      -->
                            <div class="panel-footer">
                                <h2 class="btn tags" >
                                    <i class="fa fa-share" aria-hidden="true"></i> Share:
                                </h2>

                                <div id="sharePopup" class="tags-links"></div>

                            </div>

                            <!--   Footer for Display Tags      -->
                            <div class="panel-footer">
                                <h2 class="btn tags" >
                                    <i class="fa fa-tags" aria-hidden="true"></i> Tags:
                                </h2>

                                <div class="tags-links">
                                    <?php
                                        $tags = explode(',', $post->tags);

                                        foreach ($tags AS $tag) {
                                    ?>
                                            <a href="<?php echo url('/post/tag/' .trim($tag) . '/'. $post->id); ?>" class="tag-link"><?php echo $tag; ?></a>
                                    <?php } ?>

                                </div>

                            </div>

                            <!--       Second Footer for and comments    -->
                            <?php if($user){ ?>
                            <div class="panel-footer">
                                <!-- Form to Add comment -->
                                <form action="<?php echo url('/post/' . seo($post->title) . '/' . $post->id . '/-add-comment'); ?>" method="post" id="add-comment" class="add-article-comment">
                                    <div class="form-group">
                                        <textarea class="form-control" name="comment" placeholder="Write a comment" required></textarea>
                                    </div>


                                    <div class="sbmt">
                                        <button type="submit" class="btn btn-default">comment</button>
                                    </div>
                                </form>
                                <br>
                                <?php if($success){ ?>
                                    <div class="alert alert-success" id="comment-result">
                                        <?php echo $success; ?>
                                    </div>
                                <?php } ?>
                                <?php if($errors){ ?>
                                    <div class="alert alert-danger" id="comment-result">
                                        <?php  foreach ($errors AS $error){
                                            echo $error;
                                        } ?>
                                    </div>
                                <?php } ?>

                            </div>
                            <?php } ?>

                        </div>

                    </div>

                    <aside class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Related Articles</h3>
                            </div>
                            <div class="panel-body">

                                <ul class="list-group">
                                    <?php if(!is_null($relatedPosts )) { ?>
                                        <?php foreach ($relatedPosts AS $related){ ?>

                                            <li class="list-group-item">
                                                <span class="image">
                                                    <img src="<?php echo assets('postImages/' . $related->image); ?>" class="img-circle img-responsive" alt="Article">
                                                </span>
                                                <span class="content">
                                                     <a href="<?php echo url('/post/' . seo($related->title) . '/' . $related->id); ?>">
                                                        <?php echo $related->title; ?>
                                                     </a>
                                                </span>
                                            </li>

                                        <?php } ?>
                                    <?php } else {
                                        echo "<h4 class='text-center text-warning'>This Article has not related artcile</h4>";
                                    } ?>
                                </ul>

                            </div>
                        </div>

                    </aside>
                    <br/> <br/>
                    <div class="comments col-md-12">

                        <div class="comments-container">

                            <div class="alert alert-info">
                                <h4 class="text-danger">
                                    <b><?php echo count($post->comments); ?></b>    Comments for this article
                                </h4>
                            </div>

                            <!-- loop here to display all comments -->
                            <?php foreach ($post->comments AS $comment) { ?>

                                <ul class="comments-list">

                                <div class="comment-main-level">
                                    <!-- User Image for Comment Owner -->
                                    <div class="col-xs-3 comment-avatar"><img src="<?php echo assets('userImages/' . $comment->userImage)?>" alt=""></div>

                                    <!-- User name and Time and React Icons  -->
                                    <div class="col-xs-9 comment-box">
                                        <div class="comment-head">
                                            <!-- user name -->
                                            <h6 class="comment-name by-author"><a href="<?php echo '/' . $comment->first_name . "-" . $comment->last_name . '/profile';?>"><?php echo $comment->first_name . " " . $comment->last_name; ?></a></h6>
                                            <!-- time -->
                                            <span>from <?php echo date('d-m-Y', $comment->created); ?></span>
                                        </div>

                                        <!-- Comment contents -->
                                        <div class="comment-content">
                                            <?php echo $comment->comment?>
                                        </div>
                                    </div>

                                </div>

                            </ul> <!-- Comment / End -->

                            <?php } ?>

                        </div>

                    </div>

                </section>
