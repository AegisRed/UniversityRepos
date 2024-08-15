<?php
$servername = "MySQL-8.2";
$username = "root";
$password = "";
$dbname = "scheduleaboba";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header('Content-Type: text/html; charset=UTF-8');
$conn->set_charset("utf8mb4");

$sql = "SELECT * FROM `allschedule`";

$result = $conn->query($sql);

$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
$conn->close();

// Include the table.php file
include 'table.php';
?>
