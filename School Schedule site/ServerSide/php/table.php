<?php
$servername = "MySQL-8.2";
$username = "root";
$password = "";
$dbname = "scheduleaboba";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header('Content-Type: text/html; charset=UTF-8');

// Delete logic
if (isset($_GET['delete'])) {
    $id_to_delete = $_GET['delete'];
    $delete_sql = "DELETE FROM allschedule WHERE id_sch = $id_to_delete";

    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Record deleted successfully'); window.location.href = 'table.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$sql = "SELECT * FROM allschedule"; // Assuming id_sch is the primary key
$result = $conn->query($sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
?>

<!DOCTYPE html>
<html lang="ua">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="..//CSS/styles.css">
    <title>Розклад</title>
</head>
<body>
    <div class="table-container">
        <div class="navigation-panel">
        <button onclick="window.location.href='edit_schedule.php'">Редагування розкладу</button>
        <button onclick="window.location.href='../index.html'">Головна</button> 
        <button onclick="window.location.href='../about.html'">Про розробника</button>
            </div>
        <br>
        <br />
        <table>
            <thead>
                <tr>
                    <th>День</th>
                    <th>Аудиторія</th>
                    <th>Назва пари</th>
                    <th>Група</th>
                    <th>Вчитель</th>
                    <th>Дії</th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= $row['schedule_id'] ?></td>
                        <td><?= $row['audience_name'] ?></td>
                        <td><?= $row['course_name'] ?></td>
                        <td><?= $row['group_name'] ?></td>
                        <td><?= $row['teacher_name'] ?></td>
                        <td>
                            <a href="?delete=<?= $row['id_sch'] ?>" onclick="return confirm('Are you sure you want to delete this record?');">Видалити</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <canvas id="canvas"></canvas>
    <script src="../JAVA/script.js"></script>
</body>
</html>
