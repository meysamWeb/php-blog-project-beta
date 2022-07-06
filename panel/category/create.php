<?php
    require_once '../../functions/helper.php';
    require_once '../../functions/connection.php';
    require_once '../../functions/check-login.php';
    global $connection;

    if (isset($_POST['name']) && $_POST['name'] !== '')
    {
        $query = "INSERT INTO php_project_v2.categories SET category_name = ?, created_at = NOW()";
        $statement = $connection->prepare($query);
        $statement->execute([$_POST['name']]);
        redirect('panel/category');
    }
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>پنل مدیریت - دسته بندی جدید</title>

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
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">ساخت دسته بندی جدید</h6>
                    </div>
                    <div class="card-body">
                        <form action="<?= url('panel/category/create.php') ?>" class="d-flex align-items-center" method="post">
                            <div class="form-group col-6">
                                <label for="name">نام دسته بندی جدید:</label>
                                <input type="text" class="form-control small" name="name" id="name" placeholder="نام دسته بندی را وارد کنید">
                            </div>
                            <div class="form-group col-6 mt-auto">
                                <button type="submit" class="btn btn-primary rounded px-4">ایجاد</button>
                            </div>
                        </form>
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
