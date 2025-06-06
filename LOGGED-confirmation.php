<?php
session_start();

if (!isset($_SESSION['id']) || !isset($_SESSION['confirmation'])) {
    // Redirect to the main page or error if no transaction data exists
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['id'];
$conn = new mysqli('localhost', 'root', '', 'ez_tickets');

$sql = "SELECT first_name, last_name FROM user_account WHERE id = ?";
$stmt1 = $conn->prepare($sql);
$stmt1->bind_param("i", $user_id);
$stmt1->execute();
$stmt1->bind_result($first_name, $last_name);
$stmt1->fetch();
$stmt1->close();


// Fetch the transaction details
$transaction = $_SESSION['confirmation'];

// Combined query to fetch user email and seating details
$query = "
    SELECT 
        ua.email, 
        us.seat_section, 
        us.section_number, 
        us.ticket_quantity, 
        us.total_price 
    FROM user_account ua 
    JOIN user_seating us ON ua.id = us.user_id 
    WHERE ua.id = ?";

$stmt2 = $conn->prepare($query);
$stmt2->bind_param("i", $user_id);
$stmt2->execute();
$result = $stmt2->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_email = $row['email'];
    $seat_section = $row['seat_section'];
    $section_number = $row['section_number'];
    $ticket_quantity = $row['ticket_quantity'];
    $total_price = $row['total_price'];
    /* 
    echo "User Email: $user_email<br>";
    echo "Seat Section: $seat_section<br>";
    echo "Section Number: $section_number<br>";
    echo "Ticket Quantity: $ticket_quantity<br>";
    echo "Total Price: ₱$total_price<br>";*/
} else {
    echo "No data found for the given user.";
}

// Close the statement and connection
$stmt2->close();
$conn->close();

// Clear the session data after storing it locally
unset($_SESSION['confirmation']);
?>




<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmation</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="css/Cseating-styles.css">

    <!----
    <script>
        setTimeout(() => {
        window.location.href = "LOGGED-concert.php"; // Redirect to booking page or keep refreshing
        }, 10000); // Refresh after 5 seconds-->
    </script>

</head>
<body>
    <header>
        <div class="logo-title-container">
            <div class="logo">
                <img src="images/logo.png" alt="EZ Tickets Logo">
            </div>
            <div class="title">
                <b>LPU EZ Events</b>
            </div>
        </div>
        <h2 style="color:#ddd">Welcome, <?php echo htmlspecialchars($first_name . " " . $last_name); ?>!</h2>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="LOGGED-venues.php">Event Venues</a></li>
                <li><a href="https://www.facebook.com/LYCESGOManila" target="_blank">LYCESGO</a></li>
                <li><a href="">Contact Us</a></li>
            </ul>
        </nav>
    </header>
    <div class="subheader">
        <nav>
            <ul>
                <li><a href="LOGGED-general.php">General</a></li>
                <li><a href="LOGGED-cithm.php">CITHM</a></li>
                <li><a href="LOGGED-cot.php">COT</a></li>
                <li><a href="LOGGED-graduation.php">Graduation</a></li>
            </ul>
        </nav>
        <div class="search">
            <input type="text" placeholder="Search events">
            <button>Search</button>
            <a href="db_logout.php" class="button">Logout</a>
        </div>
    </div>


<main>    
    <div class="container">
            <!-- Left Side - Seat Plan Image -->
            <div class="left">
                <img src="images/logosqr.png" alt="picture">
            </div>

            <div class="right">
                <div class="confirmation-container"> 
                    <h2>Ticket Reserved</h2>
                    <br><h2 style="color:#003366">Thank you for your reserving, <?php echo htmlspecialchars($first_name); ?>!</h2>
                    <div class="details">
                    <br><h2>Expect a confirmation email sent to you by the ticket company for the payment of your tickets.</h2><br>
                    </div>
                </div>
                
                <div class="actions">
                    <a href="index.php" class="btn">Go to Home</a>
                    <a href="LOGGED-concert.php" class="btn">Book Another Ticket</a>
                </div>
            </div>
    </div>
    </main>

    <footer>
        <p>&copy; 2025 EZ Tickets. All rights reserved.</p>
    </footer>
</body>
</html>