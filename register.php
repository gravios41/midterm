<?php
include 'db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username && $password) {
    $checkUserQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkUserResult = mysqli_query($databaseConnection, $checkUserQuery);

    if (mysqli_num_rows($checkUserResult) > 0) {
        $errorMessage = "Username already exists. Please choose a different username.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insertUserQuery = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
        if (mysqli_query($databaseConnection, $insertUserQuery)) {
            $successMessage = "Registration successful! <a href='login.php'>Login here</a>";
        } else {
            $errorMessage = "Error: " . mysqli_error($databaseConnection);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>REGISTER</h1>
        <?php if (isset($errorMessage)): ?>
            <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        <?php if (isset($successMessage)): ?>
            <div class="success-message"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php" class="register-link">Login here</a></p>
    </div>
</body>
</html>