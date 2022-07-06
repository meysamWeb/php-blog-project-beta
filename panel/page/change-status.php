<?php
    require_once '../../functions/helper.php';
    require_once '../../functions/connection.php';
    require_once '../../functions/check-login.php';
    global $connection;

    if (isset($_GET['page_id']) && $_GET['page_id'] !== ''){
        // Check for exists page id
        $query = "SELECT * FROM php_project_v2.pages WHERE page_id = ?";
        $statement = $connection->prepare($query);
        $statement->execute([$_GET['page_id']]);
        $page = $statement->fetch();

        if ($page !== false){
            // Change status
            $status = ($page->page_status == 10) ? 0 : 10;

            // Update Status
            $query = "UPDATE php_project_v2.pages SET page_status = ? WHERE page_id = ?";
            $statement = $connection->prepare($query);
            $statement->execute([$status, $_GET['page_id']]);
        }
    }
    redirect('panel/page');
