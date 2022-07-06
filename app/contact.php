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
    <title>تماس با ما</title>
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

<!--================ Hero sm banner start =================-->
<?php require_once 'hero.php' ?>
<!--================ Hero sm banner end =================-->


<!-- ================ contact section start ================= -->
<section class="section-margin--small section-margin site-main">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-home"></i></span>
                    <div class="media-body">
                        <h3>تماس با ما</h3>
                        <p>تماس با ما</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-headphone"></i></span>
                    <div class="media-body">
                        <h3><a href="tel:123456789">123456789</a></h3>
                        <p>تلفن تماس ما</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-email"></i></span>
                    <div class="media-body">
                        <h3><a href="mailto:">نشانی ایمیل</a></h3>
                        <p>برای ما پیام بفرستید</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-lg-9">
                <?php
                    function input_data($data)
                    {
                        $data = trim($data); // remove space
                        $data = stripslashes($data); // remove \ in input
                        $data = htmlspecialchars($data); // remove tag in input
                        return $data;
                    }

                    $nameErr = $emailErr = $messageErr = $subjectErr = '';
                    $name = $email = $message = $subject = $formSubmit = '';

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        // author name input
                        if (empty($_POST['name'])) {
                            $nameErr = 'نام نویسنده ضروری است';
                        } // not empty author input
                        else {
                            $name = input_data($_POST['name']);
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

                        // empty subject input
                        if (empty($_POST['subject'])) {
                            $subjectErr = 'موضوع پیام باید مشخص شود';
                        } // not empty body input
                        else {
                            $subject = input_data($_POST['subject']);
                        }

                        // empty message input
                        if (empty($_POST['message'])) {
                            $messageErr = 'متن درخواست باید کامل پر شود';
                        } // not empty body input
                        else {
                            $message = input_data($_POST['message']);
                        }
                    }
                    if (isset($_POST['name']) && $_POST['name'] !== '' and
                        isset($_POST['email']) && $_POST['email'] !== '' and
                        isset($_POST['subject']) && $_POST['subject'] !== '' and
                        isset($_POST['message']) && $_POST['message'] !== ''
                    ) {
                       $query = "INSERT INTO php_project_v2.contact_forms SET form_name = ?, form_email = ?, form_subject = ?, form_body = ?, create_at = NOW()";
                       $statement = $connection->prepare($query);
                       $statement->execute([$name, $email, $subject, $message]);

                        $formSubmit = '<small class="alert alert-success">پیام شما با موفقیت ارسال شد</small>';
                    }
                ?>
                <div class="mb-5">
                    <?= $formSubmit !== '' ? $formSubmit : '' ?>
                </div>
                <form action="" class="form-contact contact_form" method="post" id="contactForm"
                      novalidate="novalidate">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <input class="form-control" name="name" id="name" type="text"
                                       placeholder="نام خود را وارد کنید">
                                <small class="text-danger">
                                    <?= $nameErr !== '' ? $nameErr : '' ?>
                                </small>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="email" id="email" type="email"
                                       placeholder="نشانی ایمیل خود را وارد کنید">
                                <small class="text-danger">
                                    <?= $emailErr !== '' ? $emailErr : '' ?>
                                </small>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="subject" id="subject" type="text"
                                       placeholder="موضوع خود را مطرح کنید">
                                <small class="text-danger">
                                    <?= $subjectErr !== '' ? $subjectErr : '' ?>
                                </small>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <textarea class="form-control different-control w-100" name="message" id="message"
                                          cols="30" rows="5" placeholder="پیام خود را بنویسید"></textarea>
                                <small class="text-danger">
                                    <?= $messageErr !== '' ? $messageErr : '' ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center text-md-right mt-3">
                        <div class="text-left">
                            <button type="submit" class="button button--active button-contactForm">ارسال پیام</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- ================ contact section end ================= -->


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