<?php
$servername = "localhost"; // Change if your MySQL server is different
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "tourism";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO bookings1 (name, email, check_in, check_out, room_type) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("isssi", $name, $email, $check_in, $check_out, $room_type);

// Set parameters and execute
$name = $_POST['name'];
$email = $_POST['email'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$room_type = $_POST['room_type'];

if ($stmt->execute()) {
    echo "Booking successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>