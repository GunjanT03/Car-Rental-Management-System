<?php
include '../db.php';
session_start();
if (!isset($_SESSION['admin'])) header("Location: admin_login.php");

// --- Get counts ---
$total_cars = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM cars"))['total'];
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"))['total'];
$total_bookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(DISTINCT user_id) AS total FROM bookings"))['total'];

// --- Get all cars ---
$cars_result = mysqli_query($conn, "SELECT * FROM cars");

// --- Get all bookings ---
$bookings = mysqli_query($conn, "
    SELECT b.booking_id, u.name, u.email, c.car_name, c.model, b.booking_date, b.days, b.total_amount
    FROM bookings b
    JOIN users u ON b.user_id = u.id
    JOIN cars c ON b.car_id=c.car_id
    ORDER BY b.booking_date DESC
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            background-color: #1a1a1a;
            color: #f0f0f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .admin-wrapper {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Page Title */
        h1 { 
            text-align: center; 
            color: #ffffff; /* White title */
            margin-bottom: 20px;
            font-size: 36px;
        }
        h2, h3 { color: #00bfff; }

        /* Dashboard Cards */
        .dashboard-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-bottom: 40px;
            gap: 20px;
        }
        .dashboard-card {
            background-color: #2c2c2c;
            padding: 25px;
            border-radius: 12px;
            width: 250px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.5);
            transition: transform 0.3s;
        }
        .dashboard-card:hover { transform: scale(1.05); }
        .dashboard-card h3 { margin-bottom: 10px; color:#00bfff; }
        .dashboard-card p { font-size: 18px; }

        /* Tables */
        table.admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
            background-color: #2c2c2c;
            border-radius: 10px;
            overflow: hidden;
        }
        table.admin-table th, table.admin-table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #444;
        }
        table.admin-table th { background-color: #007bff; color: #fff; }
        table.admin-table tr:nth-child(even) { background-color: #333; }
        table.admin-table tr:hover { background-color: #444; }

        /* Buttons */
        .btn {
            padding: 8px 15px;
            border-radius: 6px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn:hover { background-color: #0056b3; transform: scale(1.05); }

        .btn-add { background-color: #00bfff; }
        .btn-add:hover { background-color: #0099cc; }
        .btn-logout { background-color: #ff4d4d; }
        .btn-logout:hover { background-color: #cc0000; }

        /* Add Car Button */
        .add-car-btn { text-align: right; margin-bottom: 10px; }

        /* Logout Container */
        .logout-container { text-align: center; margin: 30px 0; }
    </style>
</head>
<body>

<div class="admin-wrapper">
    <!-- Page Title -->
    <h1>Admin Dashboard</h1>

    <!-- Dashboard Cards -->
    <div class="dashboard-cards">
        <div class="dashboard-card">
            <h3>Total Cars</h3>
            <p><?= $total_cars ?></p>
        </div>
        <div class="dashboard-card">
            <h3>Total Users</h3>
            <p><?= $total_users ?></p>
        </div>
        <div class="dashboard-card">
            <h3>Total People Rented Cars</h3>
            <p><?= $total_bookings ?></p>
        </div>
    </div>

    <!-- Cars List -->
    <h3>Cars List</h3>
    <div class="add-car-btn">
        <a href="add_car.php" class="btn btn-add">Add New Car</a>
    </div>
    <table class="admin-table">
        <tr>
            <th>ID</th><th>Name</th><th>Model</th><th>Rent</th><th>Status</th><th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($cars_result)) { ?>
        <tr>
            <td><?= $row['car_id'] ?></td>
            <td><?= $row['car_name'] ?></td>
            <td><?= $row['model'] ?></td>
            <td>₹<?= $row['rent'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <a href="edit_car.php?id=<?= $row['car_id'] ?>" class="btn">Edit</a>
                <a href="delete_car.php?id=<?= $row['car_id'] ?>" class="btn" onclick="return confirm('Delete this car?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <!-- Customer Bookings Table -->
    <h3>All Customer Bookings</h3>
    <table class="admin-table">
        <tr>
            <th>Booking ID</th><th>Name</th><th>Email</th><th>Car</th><th>Model</th>
            <th>Booking Date</th><th>Days</th><th>Total Amount</th><th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($bookings)) { ?>
        <tr>
            <td><?= $row['booking_id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['car_name'] ?></td>
            <td><?= $row['model'] ?></td>
            <td><?= $row['booking_date'] ?></td>
            <td><?= $row['days'] ?></td>
            <td>₹<?= $row['total_amount'] ?></td>
            <td>
                <a href="delete_booking.php?id=<?= $row['booking_id'] ?>" class="btn" onclick="return confirm('Delete this booking?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <!-- Logout Button -->
    <div class="logout-container">
        <a href="logout.php" class="btn btn-logout">Logout</a>
    </div>
</div>

</body>
</html>