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
$stmt1 = $conn->prepare("SELECT id, first_name, password FROM user_account WHERE email = ?");
$stmt1->bind_param("s", $email);
$stmt1->execute();
$stmt1->store_result();
 
// Check if an account with the provided email exists
if ($stmt1->num_rows > 0) {

    // Bind results to variables
    $stmt1->bind_result($id, $first_name, $hashed_password);
    $stmt1->fetch();
    
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
 
// After successful login
$user_id = $row['id']; // Assuming this is the user's ID retrieved from the database

$sql = "UPDATE user_account SET is_logged_in = 1 WHERE id = ?";
$stmt2 = $conn->prepare($sql);
$stmt2->bind_param("i", $user_id);
$stmt2->execute();


 
// Close statement and connection
$stmt1->close(); 
$stmt2->close();
$conn->close();
?>
