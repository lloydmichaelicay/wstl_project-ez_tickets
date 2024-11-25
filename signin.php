<?php
session_start();

$email = ($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Database connection
$conn = new mysqli('localhost', 'root', '', 'ez_tickets');

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Prepare the SQL statement to select id, first_name, and password based on email
$stmt = $conn->prepare("SELECT id, first_name, password FROM user_account WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

// Check if an account with the provided email exists
if ($stmt->num_rows > 0) {

    // Bind results to variables
    $stmt->bind_result($id, $first_name, $hashed_password);
    $stmt->fetch();
    
    echo "Entered Password: " . $password . "<br>";
    echo "Hashed Password from Database: " . $hashed_password . "<br>";


    // Verify password
    if (password_verify($password, $hashed_password)) {

        // Store user information in session
        $_SESSION['id'] = $id;
        $_SESSION['first_name'] = $first_name;

        echo "Login successful! Welcome, " . htmlspecialchars($first_name) . ".";

        // Redirect to index page
        header("Location: index.php");
        exit;
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No account found with that email.";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
