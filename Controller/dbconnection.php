<?php
// db.php
$host = 'localhost';
$db = 'tasks';
$user = 'root';
$pass = '12345';

// Create a new PDO instance
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
