<?php
    define('SERVER_NAME', 'localhost', false);
    define('USER_NAME', 'root', false);
    define('PASSWORD', '', false);
    define('DATABASE_NAME', 'php_project_v2', false);

    global $connection;
    try {
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ);
        return $connection = new PDO("mysql:host=".SERVER_NAME.";dbname=".DATABASE_NAME.";charset=utf8", USER_NAME, PASSWORD, $options);

    } catch (PDOException $e){
        die($e->getMessage());
    }
