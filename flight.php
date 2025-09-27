<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "tourism");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $type = $_POST['type'];
    $destination = $_POST['destination'];
    $date = $_POST['date'];
    $seats = $_POST['seats'];

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, type, destination, date, seats) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssi", $user_id, $type, $destination, $date, $seats);
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
</head>
<body>
    <h2>Book a Ticket</h2>
    <form method="POST">
        <select name="type" required>
            <option value="train">Flight</option>
        </select>
        <input type="text" name="destination" required placeholder="Destination">
        <input type="date" name="date" required>
        <input type="number" name="seats" required placeholder="Number of Seats">
        <button type="submit">Book</button>
    </form>
</body>
</html>