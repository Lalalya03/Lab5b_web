<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'Lab_5b');
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// update form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $query = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $name, $role, $matric);

    if ($stmt->execute()) {
        header("Location: display.php");
        exit();
    } else {
        echo "<p style='color: red;'>An error occurred while updating the user.</p>";
    }
}

// Get user data to the form
if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $result = $conn->query("SELECT * FROM users WHERE matric = '$matric'");
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "<p style='color: red;'>User not found!</p>";
        exit();
    }
} else {
    header("Location: display.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">

        <title>Update User</title>

    </head>

    <body>
        <h1>Information Management</h1>
    
        <div class="container">
        <h2>Update User</h2>
        <form method="POST" action="">
            <label for="matric">Matric:</label>
            <input type="text" name="matric" value="<?php echo $user['matric']; ?>" readonly>

            <br>
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $user['name']; ?>" required>

            <br>
            <label for="role">Access Level:</label>
            <select name="role" required>
                <option value="lecturer" <?php if ($user['role'] == 'lecturer') echo 'selected'; ?>>Lecturer</option>
                <option value="student" <?php if ($user['role'] == 'student') echo 'selected'; ?>>Student</option>
            </select>

            <div class="actions">
                <button type="submit">Update</button>
                <a href="display.php">Cancel</a>
            </div>
        </form>
        </div>
    </body>
</html>

