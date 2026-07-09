<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $name=$_POST['name']; $email=$_POST['email']; $password=$_POST['password'];
    mysqli_query($conn, "INSERT INTO users(name,email,password) VALUES('$name','$email','$password')");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up - Car Rental</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="login-container">
<h2>Create Account</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Sign Up</button>
    <p>Already have an account? <a href="index.php">Login</a></p>
</form>
</div>
</body>
</html>
