<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    $userId = $_SESSION['user_id'];

    $taskQuery = "SELECT * FROM tasks WHERE id = $taskId AND user_id = $userId";
    $taskResult = mysqli_query($databaseConnection, $taskQuery);
    $task = mysqli_fetch_assoc($taskResult);

    if (!$task) {
        die("Task not found");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedTaskName = trim($_POST['task_name']);

    if (!empty($updatedTaskName)) {
        $updateTaskQuery = "UPDATE tasks SET task_name = '$updatedTaskName' WHERE id = $taskId";
        $updateResult = mysqli_query($databaseConnection, $updateTaskQuery);

        if ($updateResult) {
            header('Location: index.php');
            exit();
        } else {
            $errorMessage = "Failed to update the task.";
        }
    } else {
        $errorMessage = "Task name cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Edit Task</h1>
        <?php if (isset($errorMessage)): ?>
            <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        <form action="edit_task.php?id=<?php echo $taskId; ?>" method="POST">
            <input type="text" name="task_name" value="<?php echo htmlspecialchars($task['task_name']); ?>" required>
            <button type="submit">Update Task</button>
        </form>
        <p><a href="index.php" class="register-link">Back to Tasks</a></p>
    </div>
</body>
</html>
