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

// Fetch booking data if ID is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();
    $stmt->close();
}

// Handle update request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $destination = $_POST['destination'];
    $travel_date = $_POST['date'];
    $payment_method = $_POST['payment_method'];
    $card_number = $_POST['card_number'] ?? null;
    $expiry_date = $_POST['expiry_date'] ?? null;
    $cvv = $_POST['cvv'] ?? null;
    $paypal_email = $_POST['paypal_email'] ?? null;

    $updateStmt = $conn->prepare("UPDATE bookings SET name=?, email=?, phone=?, destination=?, travel_date=?, payment_method=?, card_number=?, expiry_date=?, cvv=?, paypal_email=? WHERE id=?");
    $updateStmt->bind_param("ssssssssssi", $name, $email, $phone, $destination, $travel_date, $payment_method, $card_number, $expiry_date, $cvv, $paypal_email, $id);
    $updateStmt->execute();
    $updateStmt->close();

    header("Location: admin.php"); // Redirect back to admin panel
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Booking</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Update Booking</h1>
        <form action="update.php?id=<?php echo $id; ?>" method="POST">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $booking['name']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $booking['email']; ?>" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $booking['phone']; ?>" required>

            <label for="destination">Destination:</label>
            <select id="destination" name="destination" required>
                <option value="Goa" <?php echo ($booking['destination'] == 'Goa') ? 'selected' : ''; ?>>Goa</option>
                <option value="Darjeeling" <?php echo ($booking['destination'] == 'Darjeeling') ? 'selected' : ''; ?>>Darjeeling</option>
                <option value="Varanasi" <?php echo ($booking['destination'] == 'Varanasi') ? ' selected' : ''; ?>>Varanasi</option>
                <option value="Kerala" <?php echo ($booking['destination'] == 'Kerala') ? 'selected' : ''; ?>>Kerala</option>
            </select>

            <label for="date">Travel Date:</label>
            <input type="date" id="date" name="date" value="<?php echo $booking['travel_date']; ?>" required>

            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="Credit Card" <?php echo ($booking['payment_method'] == 'Credit Card') ? 'selected' : ''; ?>>Credit Card</option>
                <option value="PayPal" <?php echo ($booking['payment_method'] == 'PayPal') ? 'selected' : ''; ?>>PayPal</option>
            </select>

            <div id="credit_card_info" style="<?php echo ($booking['payment_method'] == 'Credit Card') ? '' : 'display:none;'; ?>">
                <label for="card_number">Card Number:</label>
                <input type="text" id="card_number" name="card_number" value="<?php echo $booking['card_number']; ?>">

                <label for="expiry_date">Expiry Date:</label>
                <input type="text" id="expiry_date" name="expiry_date" value="<?php echo $booking['expiry_date']; ?>">

                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" value="<?php echo $booking['cvv']; ?>">
            </div>

            <div id="paypal_info" style="<?php echo ($booking['payment_method'] == 'PayPal') ? '' : 'display:none;'; ?>">
                <label for="paypal_email">PayPal Email:</label>
                <input type="email" id="paypal_email" name="paypal_email" value="<?php echo $booking['paypal_email']; ?>">
            </div>

            <button type="submit">Update Booking</button>
        </form>
    </div>

    <script>
        const paymentMethodSelect = document.getElementById('payment_method');
        const creditCardInfo = document.getElementById('credit_card_info');
        const paypalInfo = document.getElementById('paypal_info');

        paymentMethodSelect.addEventListener('change', function() {
            if (this.value === 'Credit Card') {
                creditCardInfo.style.display = '';
                paypalInfo.style.display = 'none';
            } else {
                creditCardInfo.style.display = 'none';
                paypalInfo.style.display = '';
            }
        });
    </script>
</body>
</html>
<?php
$conn->close();
?> 
