<?php
    session_start();
?>
<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container box_1620">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="<?= url('app') ?>">PHP</a>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav justify-content-center">
                        <li class="nav-item active"><a class="nav-link" href="<?= url('app') ?>">صفحه اصلی</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= url('app/page.php') ?>">خدمات</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= url('app/contact.php') ?>">تماس با ما</a></li>
                    </ul>
                    <ul class="nav navbar-nav nav-left login-top">
                        <?php
                            if (!isset($_SESSION['user'])){
                        ?>
                        <li>
                            <a href="<?= url('auth/login.php') ?>" class="btn btn-primary btn-sm">ورود</a>
                        </li>
                        <li>
                            <a href="<?= url('auth/register.php') ?>" class="btn btn-outline-success btn-sm">ثبت نام</a>
                        </li>
                        <?php
                            } else {
                        ?>
                        <li>
                            <a href="<?= url('auth/logout.php') ?>" class="btn btn-danger btn-sm">خروج</a>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
