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
    <?php
        if (isset($_GET['cat_id']) && $_GET['cat_id'] !== '') {
            $query = "SELECT * FROM php_project_v2.categories WHERE status = ? AND category_id = ?";
            $statement = $connection->prepare($query);
            $statement->execute([10, $_GET['cat_id']]);
            $category = $statement->fetch();
            if ($category !== false){
                ?>
                <title><?= $category->category_name ?></title>
                <?php
            }} else {
            redirect('app/index.php');
        }
    ?>
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

<!--================ Hero sm Banner start =================-->
<?php require_once 'hero.php'?>
<!--================ Hero sm Banner end =================-->



<!--================ Start Blog Post Area =================-->
<section class="blog-post-area section-margin site-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <?php
                        $query = "SELECT categories.*,posts.* FROM php_project_v2.categories LEFT JOIN php_project_v2.posts ON categories.category_id = posts.category_id WHERE status = ? AND categories.category_id = ?";
                        $statement = $connection->prepare($query);
                        $statement->execute([10, $_GET['cat_id']]);

                        $categories = $statement->fetchAll();
                        if ($categories != false) {
                        foreach ($categories as $category){
                            ?>
                            <div class="col-md-6">
                                <div class="single-recent-blog-post card-view">
                                    <div class="thumb">
                                        <img class="card-img rounded-0" src="<?= assets($category->post_image) ?>" alt="">
                                    </div>
                                    <div class="details mt-20">
                                        <a href="<?= url('app/blog-details.php?post_id=' . $category->post_id) ?>">
                                            <h3><?= $category->post_title ?></h3>
                                        </a>
                                        <p><?= substr($category->post_body, 0, 290) . ' ...' ?></p>
                                        <div class="text-left">
                                            <a class="button" href="<?= url('app/blog-details.php?post_id=' . $category->post_id) ?>">مطالعه بیشتر <i class="ti-arrow-left"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } }else{
                    ?>
                    <div class="main_blog_details col-lg-12">
                        <blockquote class="blockquote">
                            <p class="mb-0">دسته بندی ای که به دنبال آن هستید وجود ندارد ...</p>
                        </blockquote>
                    </div>
                            <?php
                        }
                    ?>
                </div>

            </div>


            <!-- Start Blog Post Siddebar -->
            <?php require_once 'layouts/sidebar.php'?>
        </div>
        <!-- End Blog Post Siddebar -->
    </div>
</section>
<!--================ End Blog Post Area =================-->

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