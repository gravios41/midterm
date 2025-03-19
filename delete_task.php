<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    $deleteTaskQuery = "DELETE FROM tasks WHERE id = $taskId";
    mysqli_query($databaseConnection, $deleteTaskQuery);
}
header('Location: index.php');
exit();
?>