<?php
include 'db.php'; 
session_start();

// Redirect to login if user not logged in
if (!isset($_SESSION['user'])) header("Location: index.php");

// Fetch all available cars
$result = mysqli_query($conn, "SELECT * FROM cars WHERE status='Available'");

// Fetch user info and total bookings
$user_email = $_SESSION['user'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE email='$user_email'"));
$user_id = $user['id'];
$total_bookings = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM bookings WHERE user_id=$user_id"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Available Cars</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #1a1a1a;
            color: #f0f0f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0; padding: 0;
        }
        h2 {
            text-align: center;
            color: #00bfff;
            margin-top: 30px;
        }
        .top-buttons {
            text-align: center;
            margin: 20px 0;
        }
        .top-buttons a {
            display: inline-block;
            margin: 0 10px;
            padding: 12px 25px;
            background-color: #00bfff;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
        }
        .top-buttons a:hover {
            background-color: #0077aa;
            transform: scale(1.05);
        }
        .cars-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
            padding: 30px;
        }
        .car-card {
            background-color: #2c2c2c;
            padding: 20px;
            border-radius: 12px;
            width: 250px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
            transition: transform 0.3s;
        }
        .car-card:hover {
            transform: translateY(-5px);
        }
        .car-card img {
            width: 100%;
            height: 150px;
            border-radius: 8px;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .car-card h3 {
            color: #00bfff;
            margin-bottom: 10px;
        }
        .car-card p {
            margin: 8px 0;
            color: #ddd;
        }
        .car-card a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.3s;
        }
        .car-card a:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .logout-link {
            display: block;
            text-align: center;
            margin: 30px 0;
            color: #ff4d4d;
            text-decoration: none;
            font-weight: bold;
        }
        .logout-link:hover {
            color: #cc0000;
        }
    </style>
</head>
<body>

<h2>Available Cars</h2>

<div class="top-buttons">
    <a href="success.php">View My Bookings (<?= $total_bookings ?>)</a>
    <a href="contact.php">Contact Us</a>
</div>

<div class="cars-container">
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<div class="car-card">
    <?php if (!empty($row['image'])) { ?>
        <img src="<?= $row['image'] ?>" alt="<?= $row['car_name'] ?>">
    <?php } else { ?>
        <img src="images/default_car.jpg" alt="Default Car">
    <?php } ?>
    <h3><?= $row['car_name'] ?> (<?= $row['model'] ?>)</h3>
    <p>Rent: ₹<?= $row['rent'] ?> per day</p>
    <a href="book_car.php?car_id=<?= $row['car_id'] ?>">Book Now</a>
</div>
<?php } ?>
</div>

<a href="logout.php" class="logout-link">Logout</a>

</body>
</html>
