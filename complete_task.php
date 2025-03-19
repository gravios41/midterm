<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    $completeTaskQuery = "UPDATE tasks SET is_completed = 1 WHERE id = $taskId";
    mysqli_query($databaseConnection, $completeTaskQuery);
}
header('Location: index.php');
exit();
?>