<div class="col-lg-4 sidebar-widgets">
    <div class="widget-wrap">

        <div class="single-sidebar-widget post-category-widget">
            <h4 class="single-sidebar-widget__title">دسته بندی</h4>
            <ul class="cat-list mt-20">
                <?php
                    $query = "SELECT * FROM php_project_v2.categories WHERE status = ?";
                    $statement = $connection->prepare($query);
                    $statement->execute([10]);
                    $categories = $statement->fetchAll();
                    foreach ($categories as $category){
                ?>
                <li>
                    <a href="<?= url('app/category.php?cat_id=' . $category->category_id) ?>" class="d-flex justify-content-between">
                        <p><?= $category->category_name ?></p>
                    </a>
                </li>
                <?php
                    }
                ?>
            </ul>
        </div>

        <div class="single-sidebar-widget popular-post-widget">
            <h4 class="single-sidebar-widget__title">پست های پیشنهادی</h4>
            <div class="popular-post-list">
                <?php
                    $query = "SELECT * FROM php_project_v2.posts WHERE post_status = ? LIMIT 0,3";
                    $statement = $connection->prepare($query);
                    $statement->execute([10]);
                    $posts = $statement->fetchAll();
                    foreach ($posts as $post){
                ?>
                <div class="single-post-list">
                    <div class="thumb">
                        <img class="card-img rounded-0" src="<?= assets($post->post_image) ?>" alt="">
                        <ul class="thumb-info">
                            <li><a href="#">مدیر</a></li>
                            <li><a href="#"><?= $post->post_comment_count?> دیدگاه</a></li>
                        </ul>
                    </div>
                    <div class="details mt-20">
                        <a href="<?= url('app/blog-details.php?post_id=' . $post->post_id) ?>">
                            <h6><?= $post->post_title ?></h6>
                        </a>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>

    </div>
</div>
