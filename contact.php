<?php
// contact.php
session_start();
$conn = new mysqli("localhost", "root", "", "tourism");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Your message has been sent successfully!');</script>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wayfarer</title>
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
<header>

        <nav class="navbar" data-navbar>
    
              <div class="navbar-top">
    
                <a href="#" class="logo">
                  <img src="./assets/images/logo-blue.svg" alt="Tourly logo">
                </a>
    
                <button class="nav-close-btn" aria-label="Close Menu" data-nav-close-btn>
                  <ion-icon name="close-outline"></ion-icon>
                </button>
    
              </div>
    
              <ul class="navbar-list">
    
                <li>
                  <a href="index.html" class="navbar-link" data-nav-link>home</a>
                </li>
    
                <li>
                  <a href="about.html" class="navbar-link" data-nav-link>about us</a>
                </li>
    
                <li>
                  <a href="destination.html" class="navbar-link" data-nav-link>destination</a>
                </li>
    
                <li>
                  <a href="package.html" class="navbar-link" data-nav-link>packages</a>
                </li>
    
                <li>
                  <a href="gallery.html" class="navbar-link" data-nav-link>gallery</a>
                </li>
    
                <li>
                  <a href="contact.php" class="navbar-link" data-nav-link>contact us</a>
                </li>
                <li>
                  <a href="ticket.html" class="navbar-link" data-nav-link>Ticket</a>
                </li>
                <li>
                  <a href="admin_login.html" class="navbar-link" data-nav-link>Admin</a>
                </li>
    
              </ul>
    
            </nav>
         
    </header>

    <div class="container">
        <h2>Get in Touch</h2>
        <p>If you have any questions, feel free to reach out to us using the form below:</p>
       
        <form id="contactForm" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required placeholder="Your Name">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required placeholder="Your Email">

            <label for="message">Message:</label>
            <textarea id="message" name="message" required placeholder="Your Message" rows="5"></textarea>

            <button type="submit">Send Message</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Wayfarer. All rights reserved.</p>
    </footer>
</body>
</html>