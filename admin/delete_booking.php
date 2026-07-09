<?php
include '../db.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // First, update car status to Available before deleting booking
    $booking = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bookings WHERE booking_id=$booking_id"));
    if ($booking) {
        $car_id = $booking['car_id'];
        mysqli_query($conn, "UPDATE cars SET status='Available' WHERE car_id=$car_id");
        mysqli_query($conn, "DELETE FROM bookings WHERE booking_id=$booking_id");
    }

    header("Location: dashboard.php");
    exit;
}
?>
