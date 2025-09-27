<?php
session_start();
$conn = new mysqli("localhost", "root", "", "train_ticket_booking");

if (!isset($_GET['id'])) {
    die("No ticket ID provided.");
}

$booking_id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if (!$booking) {
    die("Booking not found.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Ticket</title>
    <link rel="stylesheet" href="admin_login_styles.css">
    <style>
        body { font-family: Arial, sans-serif; }
        .ticket { border: 1px solid #000; padding: 20px; width: 300px; margin: auto; }
    </style>
</head>
<body>
    <div class="ticket">
        <h2>Ticket</h2>
        <p>Train: <?php echo htmlspecialchars($booking['train_name']); ?></p>
        <p>Destination: <?php echo htmlspecialchars($booking['destination']); ?></p>
        <p>Date: <?php echo htmlspecialchars($booking['travel_date']); ?></p>
        <p>Seats: <?php echo htmlspecialchars($booking['seats']); ?></p>
    </div>
    <button onclick="window.print()">Print Ticket</button>
</body>
</html>