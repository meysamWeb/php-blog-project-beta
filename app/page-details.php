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
        if (isset($_GET['page_id']) && $_GET['page_id'] !== '') {
            $query = "SELECT * FROM php_project_v2.pages WHERE page_status = ? AND page_id = ?";
            $statement = $connection->prepare($query);
            $statement->execute([10, $_GET['page_id']]);
            $page = $statement->fetch();
            if ($page !== false){
    ?><meta name="description" content="<?= $page->page_meta_keyword ?>">
    <meta name="keywords" content="<?= $page->page_meta_description ?>">
    <title><?= $page->page_title ?></title>
    <?php
        }} else {
            redirect('app/page.php');
        }
    ?>
    <link rel="icon" href="<?= assets('app/assets/img/Fevicon.png') ?>" type="image/png">

    <link rel="stylesheet" href="<?= assets('app/assets/vendors/bootstrap/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= assets('app/assets/vendors/fontawesome/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= assets('app/assets/vendors/themify-icons/themify-icons.css') ?>">
    <link rel="stylesheet" href="<?= assets('app/assets/vendors/linericon/style.css') ?>">
    <link rel="stylesheet" href="<?= assets('app/assets/vendors/owl-carousel/owl.theme.default.min.css') ?>">
    <link rel="stylesheet" href="<?= assets('app/assets/vendors/owl-carousel/owl.carousel.min.css') ?>">

    <link rel="stylesheet" href="<?= assets('app/assets/css/style.css') ?>">
</head>
<body>
<!--================Header Menu Area =================-->
<?php require_once 'layouts/top-nav.php' ?>
<!--================Header Menu Area =================-->

<!--================ Hero sm Banner start =================-->
<?php require_once 'hero.php' ?>
<!--================ Hero sm Banner end =================-->


<!--================ Start Blog Post Area =================-->
<section class="blog-post-area section-margin site-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php
                    $query = "SELECT * FROM php_project_v2.pages WHERE page_status = ? AND page_id = ?";
                    $statement = $connection->prepare($query);
                    $statement->execute([10, $_GET['page_id']]);
                    $page = $statement->fetch();
                    if ($page !== false){
                ?>
                <div class="main_blog_details">
                    <img class="img-fluid" src="<?= assets($page->page_image) ?>" alt="">
                    <h4><?= $page->page_title ?></h4>
                    <p class="text-justify text-height-2"><?= $page->page_body ?></p>
                </div>
                <?php
                } else {
                ?>
                <div class="main_blog_details">
                    <blockquote class="blockquote">
                        <p class="mb-0">خدماتی که به دنبال آن هستید وجود ندارد ...</p>
                    </blockquote>
                </div>
                <?php
                    }
                ?>
            </div>

            <!-- Start Blog Post Siddebar -->
            <?php require_once 'layouts/sidebar.php' ?>
        </div>
        <!-- End Blog Post Siddebar -->
    </div>
</section>
<!--================ End Blog Post Area =================-->

<!--================ Start Footer Area =================-->
<?php require_once 'layouts/footer.php' ?>
<!--================ End Footer Area =================-->

<script src="<?= assets('app/assets/vendors/jquery/jquery-3.2.1.min.js') ?>"></script>
<script src="<?= assets('app/assets/vendors/bootstrap/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= assets('app/assets/vendors/owl-carousel/owl.carousel.min.js') ?>"></script>
<script src="<?= assets('app/assets/js/jquery.ajaxchimp.min.js') ?>"></script>
<script src="<?= assets('app/assets/js/mail-script.js') ?>"></script>
<script src="<?= assets('app/assets/js/main.js') ?>"></script>
</body>
</html>