<?php
$servername = "localhost";
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$dbname = "tourism";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO bookings (name, email, phone, destination, travel_date, payment_status) VALUES (?, ?, ?, ?, ?, 'Pending')");
$stmt->bind_param("sssss", $name, $email, $phone, $destination, $travel_date);

// Set parameters and execute
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$destination = $_POST['destination'];
$travel_date = $_POST['date'];
$stmt->execute();

// Payment processing logic here (e.g., integrate with PayPal or Stripe)

// Assuming payment is successful
$stmt->close();
$conn->close();

echo "Booking successful! Please proceed to payment.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit booking</title>
    <link rel="stylesheet" href="submit_booking_style.css">
</head>
<body>
    
</body>
</html>