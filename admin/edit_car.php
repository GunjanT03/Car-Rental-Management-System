<?php
include '../db.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

// Get car ID
if (!isset($_GET['id'])) {
    header("Location:dashboard.php");
    exit;
}

$id = $_GET['id'];
$car = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM cars WHERE car_id=$id"));

// Update car details when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['car_name'];
    $model = $_POST['model'];
    $rent = $_POST['rent'];
    $status = $_POST['status'];

    // Check if a new image was uploaded
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../images/";
        $file_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $file_name;
        $image_path = "images/" . $file_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Update with new image
            mysqli_query($conn, "UPDATE cars SET car_name='$name', model='$model', rent='$rent', status='$status', image='$image_path' WHERE car_id=$id");
        } else {
            echo "<script>alert('Failed to upload new image!');</script>";
        }
    } else {
        // Update without changing image
        mysqli_query($conn, "UPDATE cars SET car_name='$name', model='$model', rent='$rent', status='$status' WHERE car_id=$id");
    }

    echo "<script>alert('Car updated successfully!'); window.location='dashboard.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Car</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            background-color: #1a1a1a;
            color: #f0f0f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .edit-container {
            width: 400px;
            margin: 50px auto;
            background-color: #2c2c2c;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.5);
        }
        h2 {
            text-align: center;
            color: #00bfff;
            margin-bottom: 25px;
        }
        label {
            font-weight: bold;
            color: #ccc;
        }
        input[type="text"], input[type="number"], select, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 18px 0;
            border: none;
            border-radius: 8px;
            background-color: #1f1f1f;
            color: #fff;
        }
        .car-image {
            display: block;
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 2px solid #00bfff;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #00bfff;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background-color: #0077aa;
            transform: scale(1.05);
        }
        .back-btn {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #00bfff;
            text-decoration: none;
            font-weight: bold;
        }
        .back-btn:hover {
            color: #fff;
        }
    </style>
</head>
<body>

<div class="edit-container">
    <h2>Edit Car</h2>

    <form method="POST" enctype="multipart/form-data">
        <?php if (!empty($car['image'])) { ?>
            <img src="../<?= $car['image'] ?>" alt="Car Image" class="car-image">
        <?php } else { ?>
            <img src="../images/default_car.jpg" alt="Default Car" class="car-image">
        <?php } ?>

        <label>Car Name:</label>
        <input type="text" name="car_name" value="<?= $car['car_name'] ?>" required>

        <label>Model:</label>
        <input type="text" name="model" value="<?= $car['model'] ?>" required>

        <label>Rent (₹ per day):</label>
        <input type="number" name="rent" value="<?= $car['rent'] ?>" required>

        <label>Status:</label>
        <select name="status">
            <option value="Available" <?= $car['status']=='Available'?'selected':'' ?>>Available</option>
            <option value="Booked" <?= $car['status']=='Booked'?'selected':'' ?>>Booked</option>
        </select>

        <label>Change Car Image:</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit">Update Car</button>
    </form>

    <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
</div>

</body>
</html>
