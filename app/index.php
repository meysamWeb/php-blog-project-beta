<?php
    require_once '../functions/helper.php';
    require_once '../functions/connection.php';
    global $connection;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>صفحه اصلی</title>
    <link rel="icon" href="<?= assets('app/assets/img/Fevicon.png') ?>" type="image/png">

    <link rel="stylesheet" href="<?= assets('app/assets/vendors/bootstrap/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= assets('app/assets/vendors/fontawesome/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= assets('app/assets/vendors/themify-icons/themify-icons.css')?>">
    <link rel="stylesheet" href="<?= assets('app/assets/vendors/linericon/style.css') ?>">
    <link rel="stylesheet" href="<?= assets('app/assets/vendors/owl-carousel/owl.theme.default.min.css') ?>">
    <link rel="stylesheet" href="<?= assets('app/assets/vendors/owl-carousel/owl.carousel.min.css') ?>">

    <link rel="stylesheet" href="<?= assets('app/assets/css/style.css')?>">
</head>
<body>
<!--================Header Menu Area =================-->
<?php require_once 'layouts/top-nav.php'?>
<!--================Header Menu Area =================-->

<main class="site-main">
    <!--================Hero Banner start =================-->
    <?php require_once 'hero.php'?>
    <!--================Hero Banner end =================-->

    <!--================ service start =================-->
    <section>
        <div class="container mb-5">
            <h2>خدمات ما</h2>
            <div class="card-deck">
                <?php
                    $query = "SELECT * FROM php_project_v2.pages WHERE page_status = ? LIMIT 0,3";
                    $statement = $connection->prepare($query);
                    $statement->execute([10]);
                    $pages = $statement->fetchAll();
                    foreach ($pages as $page){
                ?>
                <div class="card service">
                    <img class="card-img-top" src="<?= assets($page->page_image) ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="<?= url('app/page-details.php?page_id=' . $page->page_id) ?>"><?= $page->page_title ?></a>
                        </h5>
                        <p class="card-text"><?= substr($page->page_body,0, 90). ' ...' ?></p>
                        <div class="text-left">
                            <a href="<?= url('app/page-details.php?page_id=' . $page->page_id) ?>" class="btn btn-primary">مشاهده بیشتر</a>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </section>
    <!--================ service end =================-->

    <!--================ Start Blog Post Area =================-->
    <section class="blog-post-area section-margin mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <?php
                        $query = "SELECT * FROM php_project_v2.posts WHERE post_status = ? ORDER BY post_id DESC";
                        $statement = $connection->prepare($query);
                        $statement->execute([10]);
                        $posts = $statement->fetchAll();
                        foreach ($posts as $post){
                    ?>
                    <div class="single-recent-blog-post">
                        <div class="thumb">
                            <img class="img-fluid" src="<?= assets($post->post_image) ?>" alt="">
                            <ul class="thumb-info">
                                <li><a href="#"><i class="ti-user"></i>مدیر</a></li>
                                <li><i class="ti-notepad"></i><a href="#"><?= $post->create_at ?></a></li>
                                <li><i class="ti-themify-favicon"></i><a href="#"><?= $post->post_comment_count?> دیدگاه</a></li>
                            </ul>
                        </div>
                        <div class="details mt-20">
                            <a href="">
                                <h3><a href="<?= url('app/blog-details.php?post_id=' . $post->post_id) ?>"><?= $post->post_title ?></a></h3>
                            </a>
                            <p><?= substr($post->post_body,0,510) . ' ...' ?></p>
                            <div class="text-left">
                                <a class="button" href="<?= url('app/blog-details.php?post_id=' . $post->post_id) ?>">بیشتر بدانید <i class="ti-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>

                </div>

                <!-- Start Blog Post Siddebar -->
                <?php require_once 'layouts/sidebar.php'?>
            </div>
            <!-- End Blog Post Siddebar -->
        </div>
    </section>
    <!--================ End Blog Post Area =================-->
</main>

<!--================ Start Footer Area =================-->
<?php require_once 'layouts/footer.php'?>
<!--================ End Footer Area =================-->

<script src="<?= assets('app/assets/vendors/jquery/jquery-3.2.1.min.js') ?>"></script>
<script src="<?= assets('app/assets/vendors/bootstrap/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= assets('app/assets/vendors/owl-carousel/owl.carousel.min.js') ?>"></script>
<script src="<?= assets('app/assets/js/jquery.ajaxchimp.min.js') ?>"></script>
<script src="<?= assets('app/assets/js/mail-script.js') ?>"></script>
<script src="<?= assets('app/assets/js/main.js') ?>"></script>
</body>
</html>