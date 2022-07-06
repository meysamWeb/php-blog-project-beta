<?php
    /**
     * config base url in website
     * const BASE_URL = 'http://localhost:81/my-projects/php/blog/';
     **/
    define('BASE_URL', 'http://localhost:81/my-projects/php/test/my-site/', false);

    /**
     * redirect in website
     * redirect('panel/category');
     **/
    function redirect($url)
    {
        header('Location: ' . trim(BASE_URL, '/ ') . '/' . trim($url, '/ '));
        exit;
    }

    /**
     * assets file
     * CSS - JS - Images
     * echo assets('assets/css/style.css');
     **/
    function assets($file)
    {
        return trim(BASE_URL, ' / ') . '/' . trim($file, '/ ');
    }

    /**
     * assets file
     * link in a tag
     * echo url('panel/category');
     **/
    function url($url)
    {
        return trim(BASE_URL, ' / ') . '/' . trim($url, '/ ');
    }

    /**
     * debug on var_dump
     * $users = ['meysam', 'ali'];
     * dd($users);
     **/
    function dd($var)
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        exit;
    }