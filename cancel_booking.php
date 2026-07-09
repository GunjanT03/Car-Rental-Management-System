<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user'])) header("Location: index.php");

// Get the logged-in user's ID
$email = $_SESSION['user'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE email='$email'"));
$user_id = $user['id'];

if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Check if the booking belongs to the logged-in user
    $booking = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bookings WHERE booking_id=$booking_id AND user_id=$user_id"));
    if ($booking) {
        $car_id = $booking['car_id'];

        // Set car status back to Available
        mysqli_query($conn, "UPDATE cars SET status='Available' WHERE car_id=$car_id");

        // Delete the booking
        mysqli_query($conn, "DELETE FROM bookings WHERE booking_id=$booking_id");
    }

    header("Location: success.php"); // Redirect back to success page (confirmation)
    exit;
}
?>
