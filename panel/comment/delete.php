<?php
    require_once '../../functions/helper.php';
    require_once '../../functions/connection.php';
    require_once '../../functions/check-login.php';
    global $connection;

    if (isset($_GET['comment_id']) && $_GET['comment_id'] !== '' and
        isset($_GET['post_id']) && $_GET['post_id'] !== ''
    )
    {
        $query = "DELETE FROM php_project_v2.comments WHERE comment_id = ?";
        $statement = $connection->prepare($query);
        $statement->execute([$_GET['comment_id']]);

        $queryComment = "UPDATE php_project_v2.posts SET post_comment_count = post_comment_count - 1 WHERE post_id = ?";
        $statementComment = $connection->prepare($queryComment);
        $statementComment->execute([$_GET['post_id']]);
    }
    redirect('panel/comment');
