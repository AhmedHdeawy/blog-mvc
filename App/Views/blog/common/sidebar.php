<aside class="col-md-4">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Categories</h3>
        </div>
        <div class="panel-body">

            <ul class="list-group categories-home">
                <?php foreach ($categories AS $category) { ?>
                    <a  href="<?php echo url('category/' . seo($category->name) . '/' . $category->id); ?>" class="content">
                        <li class="list-group-item">
                            <?php echo $category->name ."<span class='pull-right'>" . $category->total_posts . "</span>"; ?>
                        </li>
                    </a>
                <?php } ?>
            </ul>

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Search</h3>
        </div>
        <div class="panel-body">


            <ul class="list-group">
                <li class="list-group-item">
                    <form action="<?php echo url('/search'); ?>" method="get" class="form-horizontal">

                        <div class="form-group" style="padding: 0px 10px">
                            <input type="search" name="q" class="form-control" placeholder="Search" autocomplete="on">
                        </div>

                        <input type="submit" value="Search" class="btn btn-danger">

                    </form>
                </li>
            </ul>

        </div>
    </div>

</aside>


</div>

</div>

</div>

</section>
