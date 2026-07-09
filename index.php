<?php
include 'db.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['user'] = $email; 
        header("Location: available_cars.php");
    } 
    else { $error = "Invalid email or password"; }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Car Rental</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="login-container">
    <h2>Car Rental Login</h2>
    <?php if(isset($error)) echo "<p class='error-msg'>$error</p>"; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <p>New user? <a href="signup.php">Sign Up</a></p>
    </form>
</div>
</body>
</html>
