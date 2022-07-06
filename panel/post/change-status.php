<?php
    require_once '../../functions/helper.php';
    require_once '../../functions/connection.php';
    require_once '../../functions/check-login.php';

    global $connection;

    if (isset($_GET['post_id']) && $_GET['post_id'] !== '')
    {
        // Check for exists post id
        $query = "SELECT * FROM php_project_v2.posts WHERE post_id = ?";
        $statement = $connection->prepare($query);
        $statement->execute([$_GET['post_id']]);
        $post = $statement->fetch();

        // Change status
        if ($post !== false)
        {
            $status = ($post->post_status == 10) ? 0 : 10;

            // Update status
            $query = "UPDATE php_project_v2.posts SET post_status = ? WHERE post_id = ?";
            $statement = $connection->prepare($query);
            $statement->execute([$status, $_GET['post_id']]);
        }

    }
    redirect('panel/post');
