<?php
include 'db.php'; 
session_start();
if(!isset($_SESSION['user'])) header("Location: index.php");

// Get user info
$email = $_SESSION['user'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE email='$email'"));
$user_id = $user['id'];

// Get all bookings of this user
$bookings = mysqli_query($conn, "SELECT b.*, c.car_name, c.model, c.status
                                 FROM bookings b
                                 JOIN cars c ON b.car_id=c.car_id
                                 WHERE b.user_id=$user_id
                                 ORDER BY b.booking_date DESC");

$total_bookings = mysqli_num_rows($bookings);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #1a1a1a;
            color: #f0f0f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        .confirmation-wrapper {
            display: flex;
            justify-content: center;
            padding: 40px 0;
        }
        .container {
            width: 95%;
            max-width: 1200px;
            background-color: #2c2c2c;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 6px 25px rgba(0,0,0,0.5);
        }
        h2 {
            text-align: center;
            color: #00bfff;
            margin-bottom: 20px;
        }
        p.total-bookings {
            text-align: center;
            font-size: 18px;
            margin-bottom: 25px;
            color: #fff;
        }

        /* Grid layout for car cards - 3 columns */
        .cars-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 columns */
            gap: 20px;
        }

        .car-card {
            background-color: #1f1f1f;
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid #00bfff;
        }
        .car-card h3 {
            margin: 0 0 10px 0;
            color: #00bfff;
        }
        .car-card p {
            margin: 5px 0;
            color: #ddd;
        }
        .btn {
            display: inline-block;
            margin: 10px 5px 0 0;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .btn.cancel {
            background-color: #ff4d4d;
        }
        .btn.cancel:hover {
            background-color: #cc0000;
            transform: scale(1.05);
        }
        .button-wrapper {
            text-align: center;
            margin-top: 30px;
        }

        /* Responsive for smaller screens */
        @media (max-width: 992px) {
            .cars-grid {
                grid-template-columns: repeat(2, 1fr); /* 2 columns on tablets */
            }
        }
        @media (max-width: 600px) {
            .cars-grid {
                grid-template-columns: 1fr; /* 1 column on mobile */
            }
        }
    </style>
</head>
<body>

<div class="confirmation-wrapper">
    <div class="container">
        <h2>Booking Confirmation</h2>
        <p class="total-bookings"><strong>Total Cars Booked:</strong> <?= $total_bookings ?></p>

        <div class="cars-grid">
        <?php while($booking = mysqli_fetch_assoc($bookings)) { ?>
            <div class="car-card">
                <h3><?= $booking['car_name'] ?> (<?= $booking['model'] ?>)</h3>
                <p><strong>Booking Date:</strong> <?= $booking['booking_date'] ?></p>
                <p><strong>Number of Days:</strong> <?= $booking['days'] ?></p>
                <p><strong>Total Amount:</strong> ₹<?= $booking['total_amount'] ?></p>
                <p><strong>Status:</strong> <?= $booking['status'] ?></p>
                <a href="cancel_booking.php?id=<?= $booking['booking_id'] ?>" class="btn cancel" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel Booking</a>
            </div>
        <?php } ?>
        </div>

        <div class="button-wrapper">
            <a href="available_cars.php" class="btn">Book Another Car</a>
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </div>
</div>

</body>
</html>
