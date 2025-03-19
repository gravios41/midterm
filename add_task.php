<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newTaskName = trim($_POST['task_name']);
    $userId = $_SESSION['user_id'];

    if (!empty($newTaskName)) {
        $insertTaskQuery = "INSERT INTO tasks (task_name, user_id) VALUES ('$newTaskName', $userId)";
        mysqli_query($databaseConnection, $insertTaskQuery);
    } else {
        echo "Task name cannot be empty.";
    }
}

header('Location: index.php');
?>