<?php
    require_once '../../functions/helper.php';
    require_once '../../functions/connection.php';
    require_once '../../functions/check-login.php';
    global $connection;

    // not set category id
    if (!isset($_GET['post_id'])) {
        redirect('panel/post');
    }
    // find category id for show category list selected
    $query = "SELECT * FROM php_project_v2.posts WHERE post_id = ?";
    $statement = $connection->prepare($query);
    $statement->execute([$_GET['post_id']]);
    $post = $statement->fetch();

    // noting find category
    if ($post === false) {
        redirect('panel/post');
    }

    // check send value in form
    if (isset($_POST['title']) && $_POST['title'] !== '' and
        isset($_POST['cat_id']) && $_POST['cat_id'] !== '' and
        isset($_POST['body']) && $_POST['body'] !== '' and
        isset($_POST['post_meta_keyword']) and
        isset($_POST['post_meta_description'])
    ) {
        // find category id
        $query = "SELECT * FROM php_project_v2.categories WHERE category_id = ?";
        $statement = $connection->prepare($query);
        $statement->execute([$_POST['cat_id']]);
        $category = $statement->fetch();

        // upload image
        if (isset($_FILES['image']) && $_FILES['image']['name'] !== ''){
            // upload allowed mimes name
            $allowedMimes = ['png', 'jpeg', 'jpg', 'gif'];
            // show mimes name upload users file
            $imageMimes = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            // check mimes name upload users file
            if (!in_array($imageMimes, $allowedMimes)){
                redirect('panel/post');
            }

            // base url project
            $basePath = dirname(dirname(__DIR__));
            // remove old image
            if (file_exists($basePath . $post->post_image)){
                unlink($basePath . $post->post_image);
            }
            // create image
            $image = '/app/assets/images/posts/' . $_FILES['image']['name'];
            // upload image
            $image_upload = move_uploaded_file($_FILES['image']['tmp_name'], $basePath . $image);

            // check category exist and image upload
            if ($category !== false && $image_upload !== false) {
                $query = "UPDATE php_project_v2.posts SET post_title = ?, post_body = ?, category_id = ?, post_image = ?, updated_at = NOW(), post_meta_keyword = ?, post_meta_description = ? WHERE post_id = ?";
                $statement = $connection->prepare($query);
                $statement->execute([
                    $_POST['title'],
                    $_POST['body'],
                    $_POST['cat_id'],
                    $image,
                    $_POST['post_meta_keyword'],
                    $_POST['post_meta_description'],
                    $_GET['post_id']
                ]);
            }
        }
        else {
            // check category exist
            if ($category !== false) {
                $query = "UPDATE php_project_v2.posts SET post_title = ?, post_body = ?, category_id = ?, updated_at = NOW(), post_meta_keyword = ?, post_meta_description = ? WHERE post_id = ?";
                $statement = $connection->prepare($query);
                $statement->execute([
                    $_POST['title'],
                    $_POST['body'],
                    $_POST['cat_id'],
                    $_POST['post_meta_keyword'],
                    $_POST['post_meta_description'],
                    $_GET['post_id']
                ]);
            }
        }

        redirect('panel/post');
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

    <title>پنل مدیریت - ویرایش پست</title>

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
                <h1 class="h3 mb-2 text-gray-800 mb-4">پست ها</h1>


                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">ویرایش پست</h6>
                    </div>
                    <div class="card-body justify-content-center d-flex">
                        <form action="<?= url('panel/post/edit.php?post_id=' . $_GET['post_id']) ?>" class="w-50" method="post" enctype="multipart/form-data">
                            <section class="form-group">
                                <label for="title">عنوان</label>
                                <input type="text" class="form-control" name="title" id="title" value="<?= $post->post_title ?>">
                            </section>
                            <section class="form-group">
                                <label for="image">تصویر</label>
                                <input type="file" class="form-control" name="image" id="image">
                                <img style="width: 90px; margin-top: 1.5rem;" src="<?= assets($post->post_image) ?>" alt="">
                            </section>
                            <section class="form-group">
                                <label for="cat_id">دسته بندی</label>
                                <select class="form-control" name="cat_id" id="cat_id">
                                    <?php
                                        $query = "SELECT * FROM php_project_v2.categories WHERE status = ?";
                                        $statement = $connection->prepare($query);
                                        $statement->execute([10]);
                                        $categories = $statement->fetchAll();
                                        foreach ($categories as $category){
                                            ?>
                                            <option value="<?= $category->category_id ?>" <?= $category->category_id == $post->category_id ? 'selected' : '' ?>><?= $category->category_name ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </section>
                            <section class="form-group">
                                <label for="body">توضیحات</label>
                                <textarea class="form-control" name="body" id="body" rows="5"><?= $post->post_body?></textarea>
                            </section>
                            <section class="form-group">
                                <hr>
                                <label for="post_meta_keyword">Meta Keyword</label>
                                <input type="text" class="form-control" name="post_meta_keyword" id="post_meta_keyword" value="<?= $post->post_meta_keyword ?>">
                                <p></p>
                                <label for="post_meta_description">Meta Description</label>
                                <input type="text" class="form-control" name="post_meta_description"
                                       id="post_meta_description" value="<?= $post->post_meta_description ?>">
                            </section>
                            <section class="form-group">
                                <button type="submit" class="btn btn-secondary">ویرایش</button>
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
