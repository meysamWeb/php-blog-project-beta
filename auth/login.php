<?php
    session_start();
    require_once '../functions/helper.php';
    require_once '../functions/connection.php';
    global $connection;

    // set again session
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
    }

    function input_data($data)
    {
        $data = trim($data); // remove space
        $data = stripslashes($data); // remove \ in input
        $data = htmlspecialchars($data); // remove tag in input
        return $data;
    }

    $emailErr = $passwordErr = $all_filedErr = '';
    $email = $password = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
    }
    // check send value in form
    if (isset($_POST['email']) && $_POST['email'] !== '' and
        isset($_POST['password']) && $_POST['password'] !== ''
    ) {
        // check unique email in table user
        $query = "SELECT * FROM php_project_v2.users WHERE user_email = ?";
        $statement = $connection->prepare($query);
        $statement->execute([$email]);
        $user = $statement->fetch();

        // find email
        if ($user !== false){

            // check verify password
            if (password_verify($password, $user->user_password)){
                $_SESSION['user'] = $user->user_email;
                redirect('panel');
            }
            // not verify password
            else {
                $passwordErr = 'رمز عبور اشتباه است';
            }
        }
        // noting find email
        else {
            $emailErr = 'نشانی ایمیل شما یافت نشد';
        }
    }
    // not set all field
    else {
        !empty($_POST) ? $all_filedErr = 'تمام فیلد ها باید پر شوند' : $all_filedErr = '';
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ورود</title>

    <!-- Custom fonts for this template-->
    <link href="<?= assets('assets/css/all.min.css') ?>" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="<?= assets('assets/css/admin-style.min.css') ?>" rel="stylesheet">
    <link href="<?= assets('assets/css/style.css') ?>" rel="stylesheet">

</head>

<body class="bg-gradient-primary site-main">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <p class="py-5"></p>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">خوش آمدید</h1>
                                </div>
                                <form class="user" action="<?= url('auth/login.php') ?>" method="post">
                                    <small class="text-danger">
                                        <?= $all_filedErr !== '' ? $all_filedErr : '' ?>
                                    </small>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                               id="exampleInputEmail" aria-describedby="emailHelp"
                                               placeholder="نشانی ایمیل خود را وارد کنید" name="email">
                                        <small class="text-danger">
                                            <?= $emailErr !== '' ? $emailErr : '' ?>
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                               id="exampleInputPassword" placeholder="رمز عبور خود را وارد کنید" name="password">
                                        <small class="text-danger">
                                            <?= $passwordErr !== '' ? $passwordErr : '' ?>
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">من را به خاطر داشته
                                                باش</label>
                                        </div>
                                    </div>
                                    <input type="submit" value="ورود به حساب کاربری"
                                           class="btn btn-primary btn-user btn-block">
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= url('auth/register.php') ?>">میخواهید حساب کاربری داشته
                                        باشید؟</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= assets('assets/js/bootstrap/jquery.min.js') ?>"></script>
<script src="<?= assets('assets/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= assets('assets/js/jquery.easing.min.js') ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= assets('assets/js/admin-panel.min.js') ?>"></script>

</body>

</html>