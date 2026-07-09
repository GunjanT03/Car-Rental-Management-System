<?php
$conn = mysqli_connect("localhost", "root", "", "car");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>\