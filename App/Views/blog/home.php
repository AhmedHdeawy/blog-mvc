<!--   Main       -->
<div  class="col-md-8" id="all">
    <?php foreach ($posts AS $post) { ?>

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
                <li class="pull-left"><i class="fa fa-tag"></i><?php echo $post->category; ?></li>
                <li><i class="fa fa-eye"></i>329</li>
                <li><i class="fa fa-comment-o"></i><?php echo $post->total_comments?></li>
                <li><i class="fa fa-heart-o"></i>121</li>
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
</div>

