<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: logticket.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "train_ticket_booking");
$result = $conn->query("SELECT * FROM bookings");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin_login_styles.css">
</head>
<body>
    <h2>Admin Panel</h2>
    <h3>Bookings</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Train Name</th>
            <th>Destination</th>
            <th>Travel Date</th>
            <th>Seats</th>
        </tr>
        <?php while ($booking = $result->fetch_assoc()): ?>
        <tr>
        
            <td><?php echo htmlspecialchars($booking['id']); ?></td>
            <td><?php echo htmlspecialchars($booking['user_id']); ?></td>
            <td><?php echo htmlspecialchars($booking['train_name']); ?></td>
            <td><?php echo htmlspecialchars($booking['destination']); ?></td>
            <td><?php echo htmlspecialchars($booking['travel_date']); ?></td>
            <td><?php echo htmlspecialchars($booking['seats']); ?></td>
        </tr>
        
        <?php endwhile; ?>
    </table>
</body>
</html>