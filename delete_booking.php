
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

    // Prepare and execute delete statement
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Booking deleted successfully.";
    } else {
        echo "Error deleting booking.";
    }

    $stmt->close();
} else {
    echo "No booking ID provided.";
}

$conn->close();
?>

<a href="admin.php">Back to Admin Panel</a>