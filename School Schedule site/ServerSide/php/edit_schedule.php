<?php
header('Content-Type: text/html; charset=UTF-8');

$servername = "MySQL-8.2";
$username = "root";
$password = "";
$dbname = "scheduleaboba";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

// Get data for dropdowns
$schedule = $conn->query("SELECT schedule_id, day_of_week from schedule");
$teachers = $conn->query("SELECT teacher_id, name FROM teacher");
$subjects = $conn->query("SELECT course_id, name FROM course");
$classrooms = $conn->query("SELECT audience_id, audience_name FROM audience");
$groups = $conn->query("SELECT group_id, name FROM `studentgroup`");

$alertMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $schedule_id = $_POST['day'];
    $teacher_id = $_POST['teacher'];
    $course_id = $_POST['course'];
    $audience_id = $_POST['audience'];
    $group_id = $_POST['group'];

    $sql = "INSERT INTO allschedule (schedule_id, teacher_name, course_name, audience_name, group_name) 
            VALUES ('$schedule_id', '$teacher_id', '$course_id', '$audience_id', '$group_id')";
    if ($conn->query($sql) === TRUE) {
        $alertMessage = "New record created successfully";
    } else {
        $alertMessage = "Error: " . $sql . "\\n" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагування розкладу</title>
    <link rel="stylesheet" href="..///css/styles.css">
</head>
<body>

    <div class="container">
        <div class="navigation-panel">
        <button onclick="window.location.href='view_schedule.php'">Перегляд розкладу</button>
        <button onclick="window.location.href='../index.html'">Головна</button> 
        <button onclick="window.location.href='../about.html'">Про розробника</button>
        </div>
        <h1>Редагування розкладу</h1>
        <form method="POST" action="edit_schedule.php">
            <label for="day">Day:</label>
            <select name="day" id="day">
                <option value="Понеділок">Понеділок</option>
                <option value="Вівторок">Вівторок</option>
                <option value="Середа">Середа</option>
                <option value="Четвер">Четвер</option>
                <option value="П'ятниця">П'ятниця</option>
                <option value="Субота">Субота</option>
                <option value="Неділя">Неділя</option>
            </select><br><br>

            <label for="teacher">Викладач:</label>
            <select name="teacher" id="teacher">
                <?php while ($row = $teachers->fetch_assoc()) { ?>
                    <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                <?php } ?>
            </select><br><br>

            <label for="course">Пара:</label>
            <select name="course" id="course">
                <?php while ($row = $subjects->fetch_assoc()) { ?>
                    <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                <?php } ?>
            </select><br><br>

            <label for="audience">Аудиторія:</label>
            <select name="audience" id="audience">
                <?php while ($row = $classrooms->fetch_assoc()) { ?>
                    <option value="<?php echo $row['audience_name']; ?>"><?php echo $row['audience_name']; ?></option>
                <?php } ?>
            </select><br><br>

            <label for="group">Група:</label>
            <select name="group" id="group">
                <?php while ($row = $groups->fetch_assoc()) { ?>
                    <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                <?php } ?>
            </select><br><br>

            <button type="submit">Додати</button>
        </form>
    </div>

    <canvas id="canvas"></canvas>
    <script src="/JAVA/script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const alertMessage = "<?php echo $alertMessage; ?>";
            if (alertMessage) {
                alert(alertMessage);
            }
        });
    </script>
</body>
</html>
