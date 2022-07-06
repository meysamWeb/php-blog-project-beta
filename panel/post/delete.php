<?php
    require_once '../../functions/helper.php';
    require_once '../../functions/connection.php';
    require_once '../../functions/check-login.php';

    global $connection;

    if (isset($_GET['post_id']) && $_GET['post_id'] !== ''){
        // Check for exists post id
        $query = "SELECT * FROM php_project_v2.posts WHERE post_id = ?";
        $statement = $connection->prepare($query);
        $statement->execute([$_GET['post_id']]);
        $post = $statement->fetch();

        // fined bas url
        $basePath = dirname(dirname(__DIR__));

        // fined image amd remove image
        if (file_exists($basePath . $post->post_image)){
            unlink($basePath . $post->post_image);
        }

        // remove post
        $query = "DELETE FROM php_project_v2.posts WHERE post_id = ?";
        $statement = $connection->prepare($query);
        $statement->execute([$_GET['post_id']]);
    }

    redirect('panel/post');