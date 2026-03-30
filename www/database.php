<?php
$dbhost = 'mariadb';
$dbname = 'bookstore';
$dbuser = 'user';
$dbpass = 'password';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}