<?php
//Start Session
session_start();

define('SITEURL', 'http://localhost:8888/temafirst/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'database');

// $db_host = LOCALHOST;
// $db_user = DB_USERNAME;
// $db_password = DB_PASSWORD;
// $db_db = DB_NAME;

$mysqli = @new mysqli(
    LOCALHOST,
    DB_USERNAME,
    DB_PASSWORD,
    DB_NAME
);

if ($mysqli->connect_error) {
    echo 'Errno: ' . $mysqli->connect_errno;
    echo '<br>';
    echo 'Error: ' . $mysqli->connect_error;
    exit();
}
