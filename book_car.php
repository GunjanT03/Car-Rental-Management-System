<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user'])) header("Location: index.php");

$car_id = $_GET['car_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $email = $_SESSION['user'];

    // Get user ID
    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE email='$email'"));
    $user_id = $user['id'];

    // Get car rent
    $car = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM cars WHERE car_id=$car_id"));
    $rent_per_day = $car['rent'];

    // Calculate number of days
    $days = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24) + 1;
    if ($days <= 0) {
        die("<script>alert('Invalid date range!'); window.history.back();</script>");
    }

    $total = $rent_per_day * $days;

    // Insert booking (allow multiple users for same date)
    $query = "INSERT INTO bookings (user_id, car_id, booking_date, days, total_amount, start_date, end_date)
              VALUES ($user_id, $car_id, CURDATE(), $days, $total, '$start_date', '$end_date')";
    mysqli_query($conn, $query);

    header("Location: success.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Car</title>
    <style>
        body {
            background-color: #1a1a1a;
            color: #f0f0f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            width: 400px;
            margin: 80px auto;
            background-color: #2c2c2c;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
        }
        h2 {
            color: #00bfff;
            text-align: center;
        }
        label {
            display: block;
            margin-top: 15px;
            color: #ddd;
        }
        input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background-color: #3b3b3b;
            color: #fff;
        }
        button {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            background-color: #00bfff;
            border: none;
            color: #fff;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background-color: #0077aa;
            transform: scale(1.05);
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #00bfff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    $car = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM cars WHERE car_id=$car_id"));
    echo "<h2>Book {$car['car_name']} ({$car['model']})</h2>";
    ?>
    <form method="POST">
        <label>Start Date:</label>
        <input type="date" name="start_date" required>

        <label>End Date:</label>
        <input type="date" name="end_date" required>

        <button type="submit">Confirm Booking</button>
    </form>

    <a href="available_cars.php" class="back-link">← Back to Available Cars</a>
</div>

</body>
</html>
