<?php
    require_once '../../functions/helper.php';
    require_once '../../functions/connection.php';
    require_once '../../functions/check-login.php';
    global $connection;

    if (isset($_GET['comment_id']) && $_GET['comment_id'] !== ''){
        // Check for exists page id
        $query = "SELECT * FROM php_project_v2.comments WHERE comment_id = ?";
        $statement = $connection->prepare($query);
        $statement->execute([$_GET['comment_id']]);
        $comment = $statement->fetch();

        if ($comment !== false){
            // Change status
            $status = ($comment->comment_status == 10) ? 0 : 10;

            // Update Status
            $query = "UPDATE php_project_v2.comments SET comment_status = ? WHERE comment_id = ?";
            $statement = $connection->prepare($query);
            $statement->execute([$status, $_GET['comment_id']]);
        }
    }
    redirect('panel/comment');
