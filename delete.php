<?php

session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'Lab_5b');
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$matric = $_GET['matric'];

$conn->query("DELETE FROM users WHERE matric = '$matric'");
header("Location: display.php");
exit();
?>
