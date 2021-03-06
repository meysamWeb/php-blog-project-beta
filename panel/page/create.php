<?php
    require_once '../../functions/helper.php';
    require_once '../../functions/connection.php';
    require_once '../../functions/check-login.php';
    global $connection;

    // check send value in form
    if (isset($_POST['title']) && $_POST['title'] !== '' and
        isset($_FILES['image']) && $_FILES['image']['name'] !== '' and
        isset($_POST['body']) && $_POST['body'] !== '' and
        isset($_POST['page_meta_keyword']) and
        isset($_POST['page_meta_description'])
    ){

        // upload allowed mimes name
        $allowedMimes = ['png', 'jpeg', 'jpg', 'gif'];
        // show mimes name upload users file
        $imageMimes = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        // check mimes name upload users file
        if (!in_array($imageMimes, $allowedMimes)){
            redirect('panel/page');
        }

        // base url project
        $basePath = dirname(dirname(__DIR__));
        // create image
        $image = '/app/assets/images/pages/' . $_FILES['image']['name'];
        // upload image
        $image_upload = move_uploaded_file($_FILES['image']['tmp_name'], $basePath . $image);

        // check category exist and image upload
        if ($image_upload !== false) {
            $query = "INSERT INTO php_project_v2.pages SET page_title = ?, page_body = ?, page_image = ?, page_meta_keyword = ?, page_meta_description = ?, create_at = NOW()";
            $statement = $connection->prepare($query);
            $statement->execute([
                $_POST['title'],
                $_POST['body'],
                $image,
                $_POST['page_meta_keyword'],
                $_POST['page_meta_description']
            ]);
        }
        redirect('panel/page');
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

    <title>?????? ???????????? - ???????? ????????</title>

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
                <h1 class="h3 mb-2 text-gray-800 mb-4">???????? ????</h1>


                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">???????? ???????? ????????</h6>
                    </div>
                    <div class="card-body justify-content-center d-flex">
                        <form action="<?= url('panel/page/create.php') ?>" class="w-50" method="post" enctype="multipart/form-data">
                            <section class="form-group">
                                <label for="title">??????????</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="??????????">
                            </section>
                            <section class="form-group">
                                <label for="image">??????????</label>
                                <input type="file" class="form-control" name="image" id="image">
                            </section>
                            <section class="form-group">
                                <label for="body">??????????????</label>
                                <textarea class="form-control" name="body" id="body" rows="5"
                                          placeholder="??????????????"></textarea>
                            </section>
                            <section class="form-group">
                                <hr>
                                <label for="page_meta_keyword">Meta Keyword</label>
                                <input type="text" class="form-control" name="page_meta_keyword" id="page_meta_keyword"
                                       placeholder="???????? ?????????? ??????????">
                                <p></p>
                                <label for="page_meta_description">Meta Description</label>
                                <input type="text" class="form-control" name="page_meta_description"
                                       id="page_meta_description" placeholder="?????????? ??????????????">
                            </section>
                            <section class="form-group">
                                <button type="submit" class="btn btn-primary">??????????</button>
                            </section>
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
