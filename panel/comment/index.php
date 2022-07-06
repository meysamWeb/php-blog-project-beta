<?php
    require_once '../../functions/helper.php';
    require_once '../../functions/connection.php';
    require_once '../../functions/check-login.php';
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

    <title>پنل مدیریت - نظرات</title>

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
        require_once '../layout/sidebar.php';
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php
                require_once '../layout/top-nva.php';
            ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800 mb-4">نظرات</h1>


                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">لیست نظرات</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-striped">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نویسنده</th>
                                    <th>آدرس ایمیل</th>
                                    <th>متن نظر</th>
                                    <th>عنوان پست</th>
                                    <th>وضعیت</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                    $query = "SELECT comments.*, posts.post_title, posts.post_id FROM php_project_v2.comments LEFT JOIN php_project_v2.posts ON comments.post_id = posts.post_id ORDER BY comment_id DESC";
                                    $statement = $connection->prepare($query);
                                    $statement->execute();
                                    $comments = $statement->fetchAll();

                                    foreach ($comments as $comment) {
                                        ?>
                                        <tr>
                                            <td><?= $comment->comment_id ?></td>
                                            <td><?= $comment->comment_author ?></td>
                                            <td><?= $comment->comment_email ?></td>
                                            <td><?= $comment->comment_body ?></td>
                                            <td><?= $comment->post_title ?></td>
                                            <td>
                                                <!-- show status in if == 10 enable else show disable -->
                                                <?= $comment->comment_status == '10'
                                                    ? '<span class="text-success">تایید شده</span>'
                                                    : '<span class="text-danger">منتظر تایید</span>'
                                                ?>
                                            </td>

                                            <td>
                                                <a href="<?= url('panel/comment/change-status.php?comment_id=' . $comment->comment_id) ?>"
                                                   class="btn btn-outline-warning btn-sm text-dark">تغییر وضعیت</a>
                                                <a href="<?= url('panel/comment/delete.php?&post_id=' . $comment->post_id . '&comment_id=' . $comment->comment_id) ?>"
                                                   class="btn btn-outline-danger btn-sm ">حذف</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php
            require_once '../layout/footer.php';
        ?>

</body>
</html>