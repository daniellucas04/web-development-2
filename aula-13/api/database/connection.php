<?php 
$dsn = "mysql:host=localhost;dbname=sch";
$username = 'root';
$password = '';

try {
    $database = new PDO($dsn, $username, $password);
} catch (PDOException $exception) {
    echo $exception->getMessage();
}