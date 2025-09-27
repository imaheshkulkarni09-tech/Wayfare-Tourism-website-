<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: logticket.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "train_ticket_booking");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $train_name = $_POST['train_name'];
    $destination = $_POST['destination'];
    $travel_date = $_POST['travel_date'];
    $seats = $_POST['seats'];

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, train_name, destination, travel_date, seats) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssi", $user_id, $train_name, $destination, $travel_date, $seats);
    $stmt->execute();
    $stmt->close();

    echo "Booking successful! <a href='print_ticket.php?id=" . $conn->insert_id . "'>Print Ticket</a>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking</title>
    <link rel="stylesheet" href="admin_login_styles.css">
</head>
<body>
    <h2>Book a Train Ticket</h2>
    <form method="POST">
        <input type="text" name="train_name" required placeholder="Train Name">
        <input type="text" name="destination" required placeholder="Destination">
        <input type="date" name="travel_date" required>
        <input type="number" name="seats" required placeholder="Number of Seats">
        <button type="submit">Book</button>
    </form>
</body>
</html>
