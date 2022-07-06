<?php
    require_once '../../functions/helper.php';
    require_once '../../functions/connection.php';
    require_once '../../functions/check-login.php';
    global $connection;

    if (isset($_GET['cat_id']) && $_GET['cat_id'] !== '')
    {
        $query = "DELETE FROM php_project_v2.categories WHERE category_id = ?";
        $statement = $connection->prepare($query);
        $statement->execute([$_GET['cat_id']]);
    }
    redirect('panel/category');
