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
    <title>خدمات ما</title>
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
                        $query = "SELECT * FROM php_project_v2.pages WHERE page_status = ?";
                        $statement = $connection->prepare($query);
                        $statement->execute([10]);

                        $pages = $statement->fetchAll();
                        foreach ($pages as $page){
                    ?>
                    <div class="col-md-6">
                        <div class="single-recent-blog-post card-view">
                            <div class="thumb">
                                <img class="card-img rounded-0" src="<?= assets($page->page_image) ?>" alt="">
                            </div>
                            <div class="details mt-20">
                                <a href="<?= url('app/page-details.php?page_id=' . $page->page_id) ?>">
                                    <h3><?= $page->page_title ?></h3>
                                </a>
                                <p><?= substr($page->page_body, 0, 120) . ' ...' ?></p>
                                <div class="text-left">
                                    <a class="button" href="<?= url('app/page-details.php?page_id=' . $page->page_id) ?>">مطالعه بیشتر <i class="ti-arrow-left"></i></a>
                                </div>
                            </div>
                        </div>
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