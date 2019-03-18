<?php
$connection;
try {
    $hostname='localhost';
    $dbname='blog_pj_practice';
    $dbuser='root';
    $dbpass='';

    $dsn = "mysql:host=$hostname;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];

    $connection = new PDO($dsn, $dbuser, $dbpass, $options);

} catch (Exception $e) {
    error_log($e->getMessage());
    exit('Something weird happened');
}