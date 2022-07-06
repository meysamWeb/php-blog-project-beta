<?php
    require_once '../../functions/helper.php';
    require_once '../../functions/connection.php';
    require_once '../../functions/check-login.php';
    global $connection;

    if (isset($_GET['page_id']) && $_GET['page_id'] !== ''){
        // Check for exists post id
        $query = "SELECT * FROM php_project_v2.pages WHERE page_id = ?";
        $statement = $connection->prepare($query);
        $statement->execute([$_GET['page_id']]);
        $page = $statement->fetch();

        // fined bas url
        $basePath = dirname(dirname(__DIR__));

        // fined image amd remove image
        if (file_exists($basePath . $page->page_image)){
            unlink($basePath . $page->page_image);
        }

        // remove post
        $query = "DELETE FROM php_project_v2.pages WHERE page_id = ?";
        $statement = $connection->prepare($query);
        $statement->execute([$_GET['page_id']]);
    }

    redirect('panel/page');