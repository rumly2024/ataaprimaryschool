<?php
session_start();
include("includes/db.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $_SESSION['admin'] = $username;
        header("Location: admin/dashboard.php");
        exit;
    } else {
        echo "Invalid credentials!";
    }
}
?>
<?php include("includes/header.php"); ?>
<h2>Admin Login</h2>
<form method="POST">
    <label>Username:</label><input type="text" name="username" required><br><br>
    <label>Password:</label><input type="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>
<?php include("includes/footer.php"); ?>
