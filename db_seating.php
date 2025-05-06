<?php
session_start();
include('db_connection.php');

// INSERT INTO ticket_inventory (event_name, total_tickets, tickets_left)
// VALUES ('NCAA 100 Volleyball', 5500, 5500);

// Ensure user is logged in
if (!isset($_SESSION['id'])) {
    die("You must be logged in to book tickets.");
} 

$user_id = $_SESSION['id'];

// Fetch user's email
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

// Retrieve and sanitize form data
$event_name = $_POST['event_name'];
$seat_section = $_POST['seat_section'];
$section_number = $_POST['section_number'];
$ticket_quantity = intval($_POST['ticket_quantity']);
$total_price = floatval($_POST['total_price']); // Use submitted price

// Start transaction
$conn->begin_transaction();

try {
    // 1. Insert booking into user_seating
    $sql1 = "INSERT INTO user_seating (
                user_id, user_email, event_name, 
                seat_section, section_number, ticket_quantity, total_price
             ) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("issssid", 
        $user_id, 
        $user_email, 
        $event_name, 
        $seat_section, 
        $section_number, 
        $ticket_quantity, 
        $total_price
    );
    $stmt1->execute();

    // 2. Update ticket_inventory (subtract from tickets_left)
    $update_inventory = "UPDATE ticket_inventory 
                         SET tickets_left = tickets_left - ? 
                         WHERE event_name = ?";
    $update_stmt = $conn->prepare($update_inventory);
    $update_stmt->bind_param("is", $ticket_quantity, $event_name);
    $update_stmt->execute();


    // Check available tickets first
    $check_sql = "SELECT tickets_left FROM ticket_inventory WHERE event_name = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $event_name);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    $available = $check_result->fetch_assoc()['tickets_left'];
    if ($available < $ticket_quantity) {
        $conn->rollback();
        die("Not enough tickets left! Only $available remaining.");
    }
} 
$check_stmt->close();


    // Commit transaction
    $conn->commit();

    // Store confirmation info in session
    $_SESSION['confirmation'] = [
        'email' => $user_email,
        'event_name' => $event_name,
        'seat_section' => $seat_section,
        'section_number' => $section_number,
        'ticket_quantity' => $ticket_quantity,
        'total_price' => $total_price,
    ];

    // Redirect to confirmation
    header("Location: LOGGED-confirmation.php");
    exit();

} catch (Exception $e) {
    $conn->rollback();
    die("Transaction failed: " . $e->getMessage());
} finally {
    // Clean up
    $email_stmt->close();
    $stmt1->close();
    $update_stmt->close();
    $conn->close();
}
?>
