<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user_id'];
$taskQuery = "SELECT * FROM tasks WHERE user_id = $userId";
$taskResult = mysqli_query($databaseConnection, $taskQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>To-Do List</h1>
        <p>Welcome, <?php echo $_SESSION['username']; ?>! <a href="logout.php">Logout</a></p>
        <form action="add_task.php" method="POST">
            <input type="text" name="task_name" placeholder="Enter a new task" required>
            <button type="submit">Add Task</button>
        </form>

        <h2>Tasks</h2>
        <?php while ($task = mysqli_fetch_assoc($taskResult)): ?>
            <div class="task <?php echo $task['is_completed'] ? 'completed' : ''; ?>">
                <?php echo htmlspecialchars($task['task_name']); ?>
                <div class="task-actions">
                    <a href="complete_task.php?id=<?php echo $task['id']; ?>">Mark as Completed</a>
                    <a href="edit_task.php?id=<?php echo $task['id']; ?>">Edit</a>
                    <a href="delete_task.php?id=<?php echo $task['id']; ?>">Delete</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>