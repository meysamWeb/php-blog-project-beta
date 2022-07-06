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
        if (isset($_GET['post_id']) && $_GET['post_id'] !== '') {
            $query = "SELECT * FROM php_project_v2.posts WHERE post_status = ? AND post_id = ?";
            $statement = $connection->prepare($query);
            $statement->execute([10, $_GET['post_id']]);
            $post = $statement->fetch();
            if ($post !== false) {
                ?>
                <meta name="description" content="<?= $post->post_meta_keyword ?>">
                <meta name="keywords" content="<?= $post->post_meta_description ?>">
                <title><?= $post->post_title ?></title>
                <?php
            }
        } else {
            redirect('app/index.php');
        } ?>
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
                $query = "SELECT posts.*, categories.category_name FROM php_project_v2.posts LEFT JOIN php_project_v2.categories ON posts.category_id = categories.category_id WHERE post_status = ? AND post_id = ?";
                $statement = $connection->prepare($query);
                $statement->execute([10, $_GET['post_id']]);
                $post = $statement->fetch();
                if ($post !== false) {
                ?>
                <div class="main_blog_details">
                    <img class="img-fluid" src="<?= assets($post->post_image) ?>" alt="">
                    <h4><?= $post->post_title ?></h4>
                    <div class="user_details">
                        <div class="float-left">
                            <a href="<?= url('app/category.php?cat_id=' . $post->category_id) ?>"><?= $post->category_name ?></a>
                        </div>
                        <div class="float-right mt-sm-0 mt-3">
                            <div class="media">
                                <div class="media-body d-flex">
                                    <h5 class="mx-2">مدیر سایت</h5>
                                    <p><?= $post->create_at ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-justify text-height-2"><?= $post->post_body ?></p>
                </div>

                <hr>
                <div class="comments-area">
                    <h4>نظرات</h4>
                    <?php
                        $query = "SELECT * FROM php_project_v2.comments WHERE comment_status = ? AND post_id = ? ORDER BY comment_id DESC";
                        $statement = $connection->prepare($query);
                        $statement->execute([10, $_GET['post_id']]);
                        $comments = $statement->fetchAll();
                        foreach ($comments as $comment){
                    ?>
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="desc">
                                    <h5><?= $comment->comment_author ?></h5>
                                    <p class="date"><?= $comment->create_at ?></p>
                                    <p class="comment">
                                       <?= $comment->comment_body ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="comment-form">
                    <h4>نظر با ارزش خود را برایمان ارسال کنید</h4>
                    <?php
                        function input_data($data)
                        {
                            $data = trim($data); // remove space
                            $data = stripslashes($data); // remove \ in input
                            $data = htmlspecialchars($data); // remove tag in input
                            return $data;
                        }
                        $authorErr = $emailErr = $messageErr = $postCommentErr =  $postCommentErr = '';
                        $author = $email = $message = '';
                        // check input data
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            // author name input
                            if (empty($_POST['author'])) {
                                $authorErr = 'نام نویسنده ضروری است';
                            } // not empty author input
                            else {
                                $author = input_data($_POST['author']);
                            }

                            // empty email input
                            if (empty($_POST['email'])) {
                                $emailErr = 'نشانی ایمیل ضروری است';
                            } // not empty email input
                            else {
                                $email = input_data($_POST['email']);
                                // pattern regex on php for email
                                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    $emailErr = "آدرس ایمیل معتبر نیست";
                                }
                            }

                            // empty body input
                            if (empty($_POST['body'])) {
                                $messageErr = 'متن نظر باید کامل پر شود';
                            } // not empty body input
                            else {
                                $message = input_data($_POST['body']);
                            }
                        }
                        if (isset($_POST['author']) && $_POST['author'] !== '' and
                            isset($_POST['email']) && $_POST['email'] !== '' and
                            isset($_POST['body']) && $_POST['body'] !== ''
                        ){
                            $query = "INSERT INTO php_project_v2.comments SET comment_author = ?, comment_email = ?, comment_body = ?, post_id = ?,create_at = NOW()";
                            $statement = $connection->prepare($query);
                            $statement->execute([$author, $email, $message, $_GET['post_id']]);

                            $queryComment = "UPDATE php_project_v2.posts SET post_comment_count = post_comment_count + 1 WHERE post_id = ?";
                            $statementComment = $connection->prepare($queryComment);
                            $statementComment->execute([$_GET['post_id']]);

                            $postCommentErr = '<small class="alert alert-success">دیدگاه شما با موفقیت ثبت شد</small>';
                        }
                    ?>
                    <form action="" method="post">
                        <?= $postCommentErr !== '' ? $postCommentErr : '' ?>
                        <div class="form-group form-inline mt-5">
                            <div class="form-group col-lg-6 col-md-6 name">
                                <input type="text" class="form-control" name="author" id="name"
                                       placeholder="نام خود را وارد کنید" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'نام خود را وارد کنید'">
                                <small class="text-danger">
                                    <?= $authorErr !== '' ? $authorErr : '' ?>
                                </small>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 email">
                                <input type="email" class="form-control" name="email" id="email"
                                       placeholder="نشانی ایمیل خود را وارد کنید"
                                       onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'نشانی ایمیل خود را وارد کنید'">
                                <small class="text-danger">
                                    <?= $emailErr !== '' ? $emailErr : '' ?>
                                </small>
                            </div>
                        </div>
                        <div class="form-group">
                                    <textarea class="form-control mb-10" rows="5" name="body"
                                              placeholder="دیدگاه خود را در این بخش وارد کنید"
                                              onfocus="this.placeholder = ''"
                                              onblur="this.placeholder = 'دیدگاه خود را در این بخش وارد کنید'"
                                              required=""></textarea>
                            <small class="text-danger">
                                <?= $messageErr !== '' ? $messageErr : '' ?>
                            </small>
                        </div>
                        <input class="button submit_btn" type="submit" value="ارسال نظر" name="submit">
                    </form>
                </div>
                <?php
                    } else {
                        ?>
                <div class="main_blog_details">
                    <blockquote class="blockquote">
                        <p class="mb-0">مطلبی که به دنبال آن هستید وجود ندارد ...</p>
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
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>