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

    <title>پنل مدیریت - دسته بندی ها</title>

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
                <h1 class="h3 mb-2 text-gray-800 mb-4">دسته بندی ها</h1>


                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">لیست دسته بندی ها</h6>
                        <a href="<?= url('panel/category/create.php')?>" class="btn btn-outline-success btn-sm">ساخت دسته بندی جدید</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-striped">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>دسته بندی</th>
                                    <th>وضعیت</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                    $query = "SELECT * FROM php_project_v2.categories";
                                    $statement = $connection->prepare($query);
                                    $statement->execute();

                                    $categories = $statement->fetchAll();
                                    foreach ($categories as $category){
                                ?>
                                <tr>
                                    <td><?= $category->category_id ?></td>
                                    <td><?= $category->category_name ?></td>
                                    <td>
                                        <!-- show status in if == 10 enable else show disable -->
                                        <?= $category->status == '10'
                                            ? '<span class="text-success">فعال</span>'
                                            : '<span class="text-danger">غیرفعال</span>'
                                        ?>
                                    </td>

                                    <td>
                                        <a href="<?= url('panel/category/edit.php?cat_id='.$category->category_id) ?>" class="btn btn-outline-primary btn-sm">ویرایش</a>
                                        <a href="<?= url('panel/category/delete.php?cat_id='.$category->category_id) ?>" class="btn btn-outline-danger btn-sm ">حذف</a>
                                        <a href="<?= url('panel/category/change-status.php?cat_id='. $category->category_id)?>" class="btn btn-outline-warning btn-sm text-dark">تغییر وضعیت</a>
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