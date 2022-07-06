<?php
    require_once '../functions/helper.php';
    require_once '../functions/connection.php';
    require_once '../functions/check-login.php';
    global $connection;
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>پنل مدیریت</title>

    <!-- Custom fonts for this template-->
    <link href="<?= assets('assets/css/all.min.css') ?>" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="<?= assets('assets/css/admin-style.min.css') ?>" rel="stylesheet">
    <link href="<?= assets('assets/css/style.css') ?>" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php
        require_once 'layout/sidebar.php';
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php
                require_once 'layout/top-nva.php';
            ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">پیشخوان</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            تعداد پست ها
                                        </div>
                                        <?php
                                            $query = "SELECT COUNT(post_id) AS post_total FROM php_project_v2.posts";
                                            $statement = $connection->prepare($query);
                                            $statement->execute();
                                            $post = $statement->fetch();
                                        ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $post->post_total ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            تعداد کاربران
                                        </div>
                                        <?php
                                            $query = "SELECT COUNT(user_id) AS user_totla FROM php_project_v2.users";
                                            $statement = $connection->prepare($query);
                                            $statement->execute();
                                            $user = $statement->fetch();
                                        ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $user->user_totla ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">تعداد دسته
                                            بندی ها
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <?php
                                                $query = "SELECT COUNT(category_id) AS cat_totla FROM php_project_v2.categories";
                                                $statement = $connection->prepare($query);
                                                $statement->execute();
                                                $category = $statement->fetch();
                                            ?>
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $category->cat_totla ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            نظرات
                                        </div>
                                        <?php
                                            $query = "SELECT COUNT(comment_id) AS comment_totla FROM php_project_v2.comments";
                                            $statement = $connection->prepare($query);
                                            $statement->execute();
                                            $comment = $statement->fetch();
                                        ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $comment->comment_totla ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->

                <div class="row">

                    <!-- Area Chart -->
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">آخرین مقالات</h6>
                                <div class="dropdown no-arrow">
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-area">
                                    <?php
                                        $query = "SELECT * FROM php_project_v2.posts ORDER BY create_at DESC LIMIT 0, 5";
                                        $statement = $connection->prepare($query);
                                        $statement->execute();
                                        $posts = $statement->fetchAll();
                                        foreach ($posts as $post) {
                                            ?>
                                            <p><a href="<?= url('app/blog-details.php?post_id=' . $post->post_id) ?>"><?= $post->post_title ?></a></p>
                                            <hr>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <div class="col-xl-8 col-lg-7">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">آخرین نظرات</h6>
                                <div class="dropdown no-arrow">
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <div class="table-responsive table-striped">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>نام نویسنده</th>
                                                <th>متن نظر</th>
                                                <th>عنوان مطلب</th>
                                                <th>وضعیت</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php
                                                $query = "SELECT comments.*,posts.post_title, posts.post_id FROM php_project_v2.comments LEFT JOIN php_project_v2.posts ON comments.post_id = posts.post_id ORDER BY comment_id DESC LIMIT 0, 4";
                                                $statement = $connection->prepare($query);
                                                $statement->execute();
                                                $comments = $statement->fetchAll();
                                                foreach ($comments as $comment){
                                                    ?>
                                                    <tr>
                                                        <td><?= $comment->comment_author  ?></td>
                                                        <td><?= substr($comment->comment_body, 0, 39). ' ...'  ?></td>
                                                        <td><a href="<?= url('app/blog-details.php?post_id=' . $comment->post_id) ?>"><?= $comment->post_title ?></a></td>

                                                        <td>
                                                            <?= $comment->comment_status == '10'
                                                                ? '<span class="text-success">فعال</span>'
                                                                : '<span class="text-danger">غیرفعال</span>'
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php
            require_once 'layout/footer.php';
        ?>

</body>

</html>