<?php
include '../db.php';
session_start();
if (!isset($_SESSION['admin'])) header("Location: admin_login.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['car_name'];
    $model = $_POST['model'];
    $rent = $_POST['rent'];

    $sql = "INSERT INTO cars (car_name, model, rent, status) VALUES ('$name', '$model', '$rent', 'Available')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Car added successfully!'); window.location='dashboard.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Car</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            background-color: #1a1a1a;
            color: #f0f0f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .form-container {
            max-width: 400px;
            margin: 60px auto;
            background-color: #2c2c2c;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.5);
            text-align: center;
        }
        .form-container h2 {
            color: #00bfff;
            margin-bottom: 25px;
        }
        .form-container input[type="text"],
        .form-container input[type="number"] {
            width: 90%;
            padding: 12px;
            margin: 10px 0 20px 0;
            border-radius: 8px;
            border: 1px solid #555;
            background-color: #1a1a1a;
            color: #f0f0f0;
            font-size: 16px;
        }
        .form-container input::placeholder {
            color: #bbb;
        }
        .form-container button {
            width: 95%;
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
        .form-container button:hover {
            background-color: #0056b3;
            transform: scale(1.03);
        }
        .back-link {
            display: block;
            margin-top: 20px;
            color: #00bfff;
            text-decoration: none;
            transition: 0.3s;
        }
        .back-link:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add New Car</h2>
    <form method="POST">
        <input type="text" name="car_name" placeholder="Car Name" required>
        <input type="text" name="model" placeholder="Model" required>
        <input type="number" name="rent" placeholder="Rent per day" required>
        <button type="submit">Add Car</button>
    </form>
    <a href="dashboard.php" class="back-link">Back to Dashboard</a>
</div>

</body>
</html>
