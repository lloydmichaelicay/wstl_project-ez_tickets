<?php
session_start();
if (!isset($_SESSION['id'])) {
    // Redirect to login page if the user is not logged in
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['id'];
$conn = new mysqli('localhost', 'root', '', 'ez_tickets');

$sql = "SELECT first_name, last_name FROM user_account WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($first_name, $last_name);
$stmt->fetch();
$stmt->close();
$conn->close();
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LPU Events</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
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
                <li><a href="test_2.html">Contact Us</a></li>
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
    
    <div class="featured"> 
    <h1>COLLEGE OF INTERNATIONAL TOURISM AND HOSPITALITY MANAGEMENT EVENTS</h1>
    </div>
    <main>

        <div class="event">
            <a href="LOGGED-mxu_seating.php"><img src="images/mxu.jpg" alt="sports"></a>
            <h3>MxU CITHM 2025 Alab Coronation Day</h3>
            <p>Venue: JPL Hall of Freedom</p>
            <p>May 16, 2025</p>
            <a href="LOGGED-mxu_seating.php" class="buy-button">Buy Tickets</a> 
        </div>

        <div class="event">
            <a href="LOGGED-asean_seating.php"><img src="images/thailand.jpg" alt="sports"></a>
            <h3>ASEAN Horizon: Thailand</h3>
            <p>Venue: JPL Hall of Freedom</p>
            <p>May 22, 2025</p>
            <a href="LOGGED-asean_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        <div class="event">
            <a href="LOGGED-seaing_seating.php"><img src="images/mice.jpg" alt="PVL"></a>
            <h3>"SEAING" Beyond the Horizon MICE Event</h3>
            <p>Venue: JPL Hall and Canteen Lobby</p>
            <p>May 30, 2025</p>
            <a href="LOGGED-seaing_seating.php" class="buy-button">Buy Tickets</a>
        </div>

    </main>
    <footer>
        <p>&copy; 2025 EZ Tickets. All rights reserved.</p>
    </footer>
</body>
</html>