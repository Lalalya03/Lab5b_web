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
$result = $conn->query("SELECT matric, name, role FROM users");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">

        <title>Display - Lab_5b</title>

        <script>
            function confirmDelete(matric) {
                if (confirm("Are you sure you want to delete this user?")) {
                    window.location.href = "delete.php?matric=" + matric;
                }
            }
        </script>
    </head>

    <body>
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>

        <h1>Information Management</h1>
        <h2>Display User</h2>

        <table>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Level</th>
                <th>Action</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['matric']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td>
                        <a href="update.php?matric=<?php echo $row['matric']; ?>">Update</a> |
                        <a href="javascript:void(0);" onclick="confirmDelete('<?php echo $row['matric']; ?>')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>

        </table>
    </body>
</html>
