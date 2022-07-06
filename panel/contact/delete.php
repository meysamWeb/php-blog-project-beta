<?php
    require_once '../../functions/helper.php';
    require_once '../../functions/connection.php';
    require_once '../../functions/check-login.php';

    global $connection;

    if (isset($_GET['form_id']) && $_GET['form_id'] !== '')
    {
        $query = "DELETE FROM php_project_v2.contact_forms WHERE form_id = ?";
        $statement = $connection->prepare($query);
        $statement->execute([$_GET['form_id']]);
    }
    redirect('panel/contact');
