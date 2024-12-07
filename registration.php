<?php
// Display success or error messages
if (isset($_GET['success'])) {
    echo "<p style='color: green;'>Registration successful!</p>";
} elseif (isset($_GET['error'])) {
    echo "<p style='color: red;'>An error occurred during registration. Please try again.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">

        <title>Registration - Lab_5b</title>

    </head>

    <body>
        <h1>Information Management</h1>
        
        <div class="container">
            <h2>Register User</h2>
            <form method="POST" action="insert.php">
                <label for="matric">Matric:</label>
                <input type="text" name="matric" required>
            
                <br>
                <label for="name">Name:</label>
                <input type="text" name="name" required>

                <br>
                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <br>
                <label for="role">Role:</label>
                <select name="role" required>
                    <option value="lecturer">Lecturer</option>
                    <option value="student">Student</option>
                </select>

                <br>
                <button type="submit">Register</button>
            </form>

            <!-- Navigation to Login Page -->
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </div>
    </body>
</html>
