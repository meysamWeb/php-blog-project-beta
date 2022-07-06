<?php
    require_once '../../functions/helper.php';
    require_once '../../functions/connection.php';
    require_once '../../functions/check-login.php';
    global $connection;

    if (isset($_GET['cat_id']) && $_GET['cat_id'] !== '')
    {
        // Check for exists post id
        $query = "SELECT * FROM php_project_v2.categories WHERE category_id = ?";
        $statement = $connection->prepare($query);
        $statement->execute([$_GET['cat_id']]);
        $category = $statement->fetch();

        // Change status
        if ($category !== false)
        {
            $status = ($category->status == 10) ? 0 : 10;

            // Update status
            $query = "UPDATE php_project_v2.categories SET status = ? WHERE category_id = ?";
            $statement = $connection->prepare($query);
            $statement->execute([$status, $_GET['cat_id']]);
        }

    }
    redirect('panel/category');

