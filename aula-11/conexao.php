<?php 

$dsn = "mysql:host=localhost;dbname=hospital";
$username = 'root';
$password = '';

try {
    $conn = new PDO($dsn, $username, $password);
} catch (PDOException $exception) {
    echo $exception->getMessage();
}