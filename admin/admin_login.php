<?php
include '../db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $result = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
  if (mysqli_num_rows($result) == 1) {
    $_SESSION['admin'] = $username;
    header("Location: dashboard.php");
  } else {
    $error = "Invalid Admin Credentials";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - Car Rental</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Center login card */
        body, html {
            height: 100%;
            margin: 0;
            background-color: #1a1a1a;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .admin-login-container {
            background-color: #2c2c2c;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.5);
            text-align: center;
            width: 350px;
        }
        .admin-login-container h2 {
            color: #00bfff;
            margin-bottom: 25px;
        }
        .admin-login-container input[type="text"],
        .admin-login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px 0;
            border-radius: 8px;
            border: 1px solid #555;
            background-color: #1a1a1a;
            color: #f0f0f0;
        }
        .admin-login-container input::placeholder {
            color: #bbb;
        }
        .admin-login-container button {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .admin-login-container button:hover {
            background-color: #0056b3;
            transform: scale(1.03);
        }
        .error-msg {
            background-color: #ff4c4c;
            color: white;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="admin-login-container">
    <h2>Admin Login</h2>
    <?php if(isset($error)) echo "<div class='error-msg'>$error</div>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
