<?php
session_start();

// Update the database to reflect the user is logged out
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    $conn = new mysqli('localhost', 'root', '', 'ez_tickets');
    $sql = "UPDATE user_account SET is_logged_in = 0 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
 
// Destroy session
session_unset();
session_destroy();

// Redirect to login page
header("Location: login.html");
exit();
?>
