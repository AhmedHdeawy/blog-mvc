<!--   Main       -->
<div  class="col-md-8" id="all">

    <!-- Check if this category has Posts or NOT   -->
    <?php if ($categories != null) { ?>

        <?php foreach ($categories->posts AS $post) { ?>

            <div class="card ">

                <div class="card-display">

                    <div class="image">
                        <img src="<?php echo assets('postImages/' . $post->image); ?>" class="img-responsive">
                    </div>
                    <div class="title">
                        <h2><?php echo $post->title; ?></h2>
                    </div>
                    <section class="article-footer">

                        <ul>
                            <li class="pull-left"><i class="fa fa-user"></i><?php echo $post->first_name . $post->last_name; ?></li>
                            <li><i class="fa fa-comment"></i><?php echo $post->total_comments?></li>
                        </ul>
                    </section>

                </div>

                <div class="card-hidden">

                    <div class="post-author">

                        <h3 class="post-autho"> <span>Posted By: </span>  <?php echo $post->first_name . " " . $post->last_name;?></h3>
                        <h3 class="post-autho"> <span>At: </span>  <?php echo date('d-m-Y', $post->created) ?></h3>
                    </div>

                    <div class="post-p">

                        <p class="">
                            <?php echo read_more(html_entity_decode($post->details), 10) . " .....";?>
                        </p>
                        <a href="<?php echo url('/post/' . seo($post->title) . '/' . $post->id); ?>" class="">Continue Reading >></a>
                    </div>


                </div>

    </div>

        <?php } ?>

    <!--   Pagination     -->

        <div class="text-center col-xs-12">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li>
                        <!--    Display First Page        -->
                        <a href="<?php echo url('category/' . seo($categories->name) . '/' . $categories->id . '/?page=1'); ?>" aria-label="Previous">
                            <span aria-hidden="true">&blacktriangleleft;</span>
                        </a>

                        <?php if($pagination->getPage() - 1 != 0){ ?>
                            <a href="<?php echo url('category/' . seo($categories->name) . '/' . $categories->id . '/?page=' . ( $pagination->getPage() - 1)); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        <?php } ?>
                    </li>
                    <?php for ($page = 1; $page <= $pagination->getLastPage(); $page++){ ?>
                        <li class="<?php echo $page == $pagination->getPage() ? 'active' : false; ?>">
                            <a href="<?php echo url('category/' . seo($categories->name) . '/' . $categories->id . '/?page=' . $page); ?>"><?php echo $page; ?></a>
                        </li>
                    <?php } ?>

                    <li>
                        <?php if($pagination->getPage()+1 <= $pagination->getLastPage() ){ ?>
                            <a href="<?php echo url('category/' . seo($categories->name) . '/' . $categories->id . '/?page=' . ( $pagination->getPage() + 1)); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        <?php } ?>
                        <a href="<?php echo url('category/' . seo($categories->name) . '/' . $categories->id . '/?page=' . $pagination->getLastPage()); ?>" aria-label="Next">
                            <span aria-hidden="true">&blacktriangleright;</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>

    <?php } else{ ?>

        <div class="alert alert-danger">
            <h3 class="text-center">No Posts In This Category</h3>
        </div>

    <?php } ?>

</div>


