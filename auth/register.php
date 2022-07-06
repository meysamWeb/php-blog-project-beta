<?php
    require_once '../functions/helper.php';
    require_once '../functions/connection.php';
    global $connection;
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ثبت نام</title>

    <!-- Custom fonts for this template-->
    <link href="<?= assets('assets/css/all.min.css') ?>" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="<?= assets('assets/css/admin-style.min.css') ?>" rel="stylesheet">
    <link href="<?= assets('assets/css/style.css') ?>" rel="stylesheet">

</head>

<body class="bg-gradient-primary site-main">

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <p class="py-5"></p>
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">ساخت حساب کاربری جدید</h1>
                        </div>
                        <?php
                            function input_data($data)
                            {
                                $data = trim($data); // remove space
                                $data = stripslashes($data); // remove \ in input
                                $data = htmlspecialchars($data); // remove tag in input
                                return $data;
                            }

                            $first_nameErr = $last_nameErr = $emailErr = $passwordErr = $password_confirmErr = $all_filedErr = '';
                            $first_name = $last_name = $email = $password = $password_confirm = '';

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                                // author first_name input
                                if (empty($_POST['first_name'])) {
                                    $first_nameErr = 'نام شما ضروری است';
                                } // not empty first_name input
                                else {
                                    $first_name = input_data($_POST['first_name']);
                                }

                                // author last_name input
                                if (empty($_POST['last_name'])) {
                                    $last_nameErr = 'نام خانودگی شما ضروری است';
                                } // not empty first_name input
                                else {
                                    $last_name = input_data($_POST['last_name']);
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

                                // empty password input
                                if (empty($_POST['password'])) {
                                    $passwordErr = 'رمز عبور ضرروی است';
                                } // not empty body input
                                else {
                                    $password = input_data($_POST['password']);
                                }

                                // empty password confirm input
                                if (empty($_POST['confirm'])) {
                                    $password_confirmErr = 'تایید رمز عبور ضروری است';
                                } // not empty body input
                                else {
                                    $password_confirm = input_data($_POST['confirm']);
                                }
                            }
                            // check send value in form
                            if (isset($_POST['first_name']) && $_POST['first_name'] !== '' and
                                isset($_POST['last_name']) && $_POST['last_name'] !== '' and
                                isset($_POST['email']) && $_POST['email'] !== '' and
                                isset($_POST['password']) && $_POST['password'] !== '' and
                                isset($_POST['confirm']) && $_POST['confirm'] !== ''
                            ) {
                                // equal filed password and confirm
                                if ($_POST['password'] === $_POST['confirm']) {

                                    // check length password = 5
                                    if (strlen($_POST['password']) > 5) {

                                        // check unique email in table user
                                        $query = "SELECT * FROM php_project_v2.users WHERE user_email = ?";
                                        $statement = $connection->prepare($query);
                                        $statement->execute([$_POST['email']]);
                                        $user = $statement->fetch();

                                        // noting find email
                                        if ($user === false) {
                                            // insert data in table
                                            $query = "INSERT INTO php_project_v2.users SET first_name = ?, last_name = ?, user_email = ?, user_password = ?, careated_at = NOW()";
                                            $password_hash = password_hash($password, PASSWORD_DEFAULT);
                                            $statement = $connection->prepare($query);
                                            $statement->execute([
                                                $first_name,
                                                $last_name,
                                                $email,
                                                $password_hash
                                            ]);
                                            redirect('auth/login.php');
                                        } // find email
                                        else {
                                            $emailErr = 'کاربری با این ایمیل قبلاً وجودد دارد';
                                        }

                                    } // check length password = 5
                                    else {
                                        $passwordErr = 'طول پسورد شما باید بیشتر از 5 کارکتر باشد';
                                    }
                                } // equal field password and confirm
                                else {
                                    $password_confirmErr = 'رمز عبور و تکرار رمز عبور با یک دیگر برابر نیستند!';
                                }
                            } // not set all field
                            else {
                                !empty($_POST) ? $all_filedErr = 'تمام فیلد ها باید پر شوند' : $all_filedErr = '';
                            }
                        ?>
                        <form class="user" method="post" action="<?= url('auth/register.php') ?>">
                            <small class="text-danger">
                                <?= $all_filedErr !== '' ? $all_filedErr : '' ?>
                            </small>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                           placeholder="نام" name="first_name">
                                    <small class="text-danger">
                                        <?= $first_nameErr !== '' ? $first_nameErr : '' ?>
                                    </small>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="exampleLastName"
                                           placeholder="نام خانوادگی" name="last_name">
                                    <small class="text-danger">
                                        <?= $last_nameErr !== '' ? $last_nameErr : '' ?>
                                    </small>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                       placeholder="نشانی ایمیل" name="email">
                                <small class="text-danger">
                                    <?= $emailErr !== '' ? $emailErr : '' ?>
                                </small>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user"
                                           id="exampleInputPassword" placeholder="رمز عبور" name="password">
                                    <small class="text-danger">
                                        <?= $passwordErr !== '' ? $passwordErr : '' ?>
                                    </small>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user"
                                           id="exampleRepeatPassword" placeholder="تایید رمز عبور" name="confirm">
                                    <small class="text-danger">
                                        <?= $password_confirmErr !== '' ? $password_confirmErr : '' ?>
                                    </small>
                                </div>
                            </div>

                            <input type="submit" value="ساخت حساب کاربری" class="btn btn-primary btn-user btn-block">
                            <hr>
                        </form>
                        <div class="text-center">
                            <a class="small" href="<?= url('auth/login.php') ?>">قبلاً ثبت نام کرده اید؟ پس وارد حساب
                                کاربری خود شوید!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="<?= assets('assets/js/bootstrap/jquery.min.js') ?>"></script>
<script src="<?= assets('assets/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= assets('assets/js/jquery.easing.min.js') ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= assets('assets/js/admin-panel.min.js') ?>"></script>

</body>

</html>