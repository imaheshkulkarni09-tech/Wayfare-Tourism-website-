<?php
$servername = "localhost"; // Change if your server is different
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "tourism"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO bookings (name, email, phone, destination, travel_date, payment_method, card_number, expiry_date, cvv, paypal_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $name, $email, $phone, $destination, $travel_date, $payment_method, $card_number, $expiry_date, $cvv, $paypal_email);

// Set parameters and execute
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$destination = $_POST['destination'];
$travel_date = $_POST['date'];
$payment_method = $_POST['payment_method'];

if ($payment_method === 'credit_card') {
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];
    $paypal_email = null; // Not applicable for credit card
} else if ($payment_method === 'paypal') {
    $card_number = null; // Not applicable for PayPal
    $expiry_date = null; // Not applicable for PayPal
    $cvv = null; // Not applicable for PayPal
    $paypal_email = $_POST['paypal_email'];
}

// Execute the statement
$stmt->execute();

echo "Booking successful!";

$stmt->close();
$conn->close();
?>