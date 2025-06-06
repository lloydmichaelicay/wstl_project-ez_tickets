<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['id'])) {
    die("You must be logged in to book tickets.");
}
      
// Retrieve the user ID from the session
$user_id = $_SESSION['id']; 

// Fetch the user's email from the user_account table
$email_query = "SELECT email FROM user_account WHERE id = ?";
$email_stmt = $conn->prepare($email_query);
$email_stmt->bind_param("i", $user_id);
$email_stmt->execute();
$email_result = $email_stmt->get_result();

if ($email_result->num_rows > 0) {
    $user_email = $email_result->fetch_assoc()['email'];
} else {
    die("Error: Unable to retrieve user email.");
} 

// Retrieve form data
$event_name = $_POST['event_name'];
$seat_section = $_POST['seat_section'];
$section_number = $_POST['section_number'];
$ticket_quantity = $_POST['ticket_quantity'];
$total_price = $_POST['total_price']; // Use the submitted price directly
$total_tickets = 5500; // default number of tickets per event


// Insert into database
$sql1 = "INSERT INTO user_seating (user_id, user_email, event_name, seat_section, section_number, ticket_quantity, total_price)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt1 = $conn->prepare($sql1);
$stmt1 ->bind_param("issssid", $user_id, $user_email, $event_name, $seat_section, $section_number, $ticket_quantity, $total_price);

$sql2 = "INSERT INTO ticket_inventory (user_id, email, event_name, total_tickets)
         VALUES (?, ?, ?, ?)";
$stmt2 = $conn->prepare($sql2);
$stmt2 ->bind_param("issi", $user_id, $user_email, $event_name, $total_tickets);
$stmt2 ->execute();

$conn->begin_transaction();

try {
    // Execute both inserts here
    $stmt1->execute();
    $stmt2->execute();

    $conn->commit(); // All good
} catch (Exception $e) {
    $conn->rollback(); // Undo both
    die("Error: " . $e->getMessage());
}


if ($stmt1->execute()) {
    echo "Your booking has been saved successfully! ";

    // Decrease tickets_left in ticket_inventory
    $update_inventory = "UPDATE ticket_inventory 
    SET tickets_left = tickets_left - ? 
    WHERE user_id = ? AND event_name = ?";
    $update_stmt = $conn->prepare($update_inventory);
    $update_stmt->bind_param("iis", $ticket_quantity, $user_id, $event_name);
    $update_stmt->execute();
    $update_stmt->close();

    $_SESSION['confirmation'] = [
        'email' => $user_email,
        'event_name' => $event_name,
        'seat_section' => $seat_section,
        'section_number' => $section_number,
        'ticket_quantity' => $ticket_quantity,
        'total_price' => $total_price,
    ];

    // Redirect to confirmation page
    header("Location: LOGGED-confirmation.php");
    exit();
    
} else {
    echo "Error: " . $stmt->error;
}


$stmt1->close();
$stmt2->close();
$email_stmt->close();
$conn->close();
?>
