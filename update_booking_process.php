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

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $payment_status = $_POST['payment_status'];

    // Prepare and execute update statement
    $stmt = $conn->prepare("UPDATE bookings SET payment_status = ? WHERE id = ?");
    $stmt->bind_param("si", $payment_status, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $update_successful=true;
    } else {
        $update_successful=false;
    }

    $stmt->close();
} else {
    $update_successful=false;
}

$conn->close();
?>

<a href="admin.php">Back to Admin Panel</a>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Booking Process</title>
    <link rel="stylesheet" href="update_booking_process_styles.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="container">
        <h1>Update Booking Process</h1>
        <?php
        // Assuming you have logic here to determine if the update was successful
        if ($update_successful) {
            echo '<div class="message confirmation">Booking updated successfully!</div>';
        } else {
            echo '<div class="message error">Error updating booking. Please try again.</div>';
        }
        ?>
        <a href="admin.php">Back to Admin Panel</a>
    </div>
</body>
</html>