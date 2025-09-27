<?php
session_start();

// Database connection
$servername = "localhost"; // Change if your server is different
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "tourism"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Query to fetch the admin user
    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();

        // Verify the password
        if ($input_password === $admin['password']) { // Plain text comparison
            // Set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $admin['username'];

            // Redirect to admin panel
            header("Location: admin.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
    $stmt->close();
}

$conn->close();
?>

