<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}
include("../includes/db.php");
include("../includes/header.php");

$student_id = $_GET['student_id'] ?? 0;

if(isset($_POST['mark'])){
    $status = $_POST['status'];
    $date = date("Y-m-d");
    $conn->query("INSERT INTO attendance (student_id, date, status) VALUES ('$student_id','$date','$status')");
}
?>
<h2>Attendance for Student ID: <?php echo $student_id; ?></h2>
<form method="POST">
    <select name="status">
        <option value="Present">Present</option>
        <option value="Absent">Absent</option>
    </select>
    <button type="submit" name="mark">Mark Attendance</button>
</form>
<hr>
<h3>Attendance History</h3>
<table border="1" cellpadding="5">
    <tr><th>Date</th><th>Status</th></tr>
<?php
$result = $conn->query("SELECT * FROM attendance WHERE student_id=$student_id ORDER BY date DESC");
while($row = $result->fetch_assoc()){
    echo "<tr><td>{$row['date']}</td><td>{$row['status']}</td></tr>";
}
?>
</table>
<?php include("../includes/footer.php"); ?>
