<?php
include 'db.php';
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user'])) header("Location: index.php");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['user'];
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert message into database
    $query = "INSERT INTO contact_messages (email, subject, message, sent_at)
              VALUES ('$email', '$subject', '$message', NOW())";
    
    if (mysqli_query($conn, $query)) {
        $success = "✅ Your message has been sent successfully!";
    } else {
        $error = "❌ Something went wrong. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <style>
        body {
            background-color: #1a1a1a;
            color: #f0f0f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 400px;
            margin: 70px auto;
            background-color: #2c2c2c;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
        }
        h2 {
            text-align: center;
            color: #00bfff;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 15px;
            color: #ddd;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: none;
            margin-top: 5px;
            background-color: #3b3b3b;
            color: #fff;
            font-size: 15px;
        }
        textarea {
            height: 100px;
            resize: none;
        }
        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background-color: #00bfff;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background-color: #0077aa;
            transform: scale(1.05);
        }
        .msg {
            text-align: center;
            margin-top: 10px;
        }
        .back-link {
            display: block;
            text-align: center;
            color: #00bfff;
            text-decoration: none;
            margin-top: 15px;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Contact Us</h2>

    <?php if (isset($success)) echo "<p class='msg' style='color:lightgreen;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p class='msg' style='color:red;'>$error</p>"; ?>

    <form method="POST">
        <label>Subject:</label>
        <input type="text" name="subject" placeholder="Enter subject" required>

        <label>Message:</label>
        <textarea name="message" placeholder="Type your message..." required></textarea>

        <button type="submit">Send Message</button>
    </form>

    <a href="available_cars.php" class="back-link">← Back to Available Cars</a>
</div>

</body>
</html>
