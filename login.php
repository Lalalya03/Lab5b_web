<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'Lab_5b');
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE matric = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $matric);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['logged_in'] = true;
        $_SESSION['role'] = $user['role'];
        header("Location: display.php");
    } else {
        header("Location: invalid.php"); // Redirect to invalid credentials page
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">

        <title>Login - Lab_5b</title>
    
    </head>

    <body>
        <h1>Information Management</h1>

        <div class="container">
            <h2>Login</h2>
            <form method="POST" action="">
                <label for="matric">Matric:</label>
                <input type="text" name="matric" required>

                <br>
                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <br>
                <button type="submit">Login</button>
            </form>

            <br>
            <p>Don't have an account? <a href="registration.php">Register here</a>.</p>
        </div>
    </body>
</html>