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

// Get booking ID from URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
   
    // Fetch booking details
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();
   
    if (!$booking) {
        echo "Booking not found.";
        exit;
    }
} else {
    echo "No booking ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Booking</title>
    <link rel="stylesheet" href="update_styles.css">
</head>
<body>
    <div class="container">
        <h1>Update Booking</h1>
        <form action="update_booking_process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $booking['id']; ?>">
            <label for="payment_status">Payment Status:</label>
            <select id="payment_status" name="payment_status">
                <option value="Pending" <?php echo $booking['payment_status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="Completed" <?php echo $booking['payment_status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
            </select>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>