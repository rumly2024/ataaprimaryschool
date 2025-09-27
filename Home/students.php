<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}
include("../includes/db.php");
include("../includes/header.php");

// Add new student
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $grade = $_POST['grade'];
    $dob = $_POST['dob'];
    $parent = $_POST['parent'];

    $sql = "INSERT INTO students (name, grade, date_of_birth, parent_contact) 
            VALUES ('$name', '$grade', '$dob', '$parent')";
    $conn->query($sql);
    echo "<p style='color:green;'>Student added successfully!</p>";
}

// Delete student
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM students WHERE id=$id");
    echo "<p style='color:red;'>Student deleted!</p>";
}
?>

<h2>Manage Students</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Student Name" required>
    <input type="text" name="grade" placeholder="Grade" required>
    <input type="date" name="dob" required>
    <input type="text" name="parent" placeholder="Parent Contact" required>
    <button type="submit" name="add">Add Student</button>
</form>

<hr>
<h3>Student List</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th><th>Name</th><th>Grade</th><th>DOB</th><th>Parent</th><th>Action</th>
    </tr>
<?php
$result = $conn->query("SELECT * FROM students");
while($row = $result->fetch_assoc()){
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['grade']}</td>
            <td>{$row['date_of_birth']}</td>
            <td>{$row['parent_contact']}</td>
            <td>
                <a href='attendance.php?student_id={$row['id']}'>Attendance</a> | 
                <a href='students.php?delete={$row['id']}' onclick='return confirm(\"Delete student?\")'>Delete</a>
            </td>
          </tr>";
}
?>
</table>

<?php include("../includes/footer.php"); ?>
