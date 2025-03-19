<?php
$databaseHost = 'localhost';
$databaseName = 'todo_list';
$databaseUser  = 'root';
$databasePassword = '';
$databaseConnection = mysqli_connect($databaseHost, $databaseUser , $databasePassword, $databaseName);

if (!$databaseConnection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>