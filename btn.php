<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location:login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Booking Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Tourism Booking Form</h1>
        <form action="submit_booking.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="destination">Destination / Package Name:</label>
            <input type="text" id="destination" name="destination" required>
              
            <label for="date">Travel Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="amount">Payment Amount:</label>
            <input type="number" id="amount" name="amount" required>

            <button type="submit">Book Now</button>
        </form>
    </div>
</body>
</html>