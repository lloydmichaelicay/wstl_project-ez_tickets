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
    <title>EZ Tickets</title>
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
                <b>EZ Tickets</b>
            </div>
        </div>
        <h2 style="color:#ddd">Welcome, <?php echo htmlspecialchars($first_name . " " . $last_name); ?>!</h2>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="LOGGED-venues.php">Event Venues</a></li>
                <li><a href="https://www.facebook.com/philippineconcerts" target="_blank">News</a></li>
                <li><a href="test_2.html">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <div class="subheader">
        <nav>
            <ul>
                <li><a href="LOGGED-concert.php">Concerts</a></li>
                <li><a href="LOGGED-sports.php">Sports</a></li>
                <li><a href="LOGGED-theater.php">Theatre Arts</a></li>
            </ul>
        </nav>
        <div class="search">
            <input type="text" placeholder="Search events">
            <button>Search</button>
            <a href="db_logout.php" class="button">Logout</a> 
        </div>
    </div>
    
    <div class="featured">
    <h1>UPCOMING SPORTING EVENTS</h1>
    </div>
    <main>
        <div class="event">
            <a href="LOGGED-ncaa_seating.php"><img src="images/ncaaB.jpg" alt="NCAA"></a>
            <h3>NCAA Season 100 Men's Basketball Game 2</h3>
            <p>Venue: SMART ARANETA COLISEUM</p>
            <p>December 07, 2024 | 2:30 PM</p>
            <a href="LOGGED-ncaa_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        <div class="event">
            <a href="LOGGED-uaap_seating.php"><img src="images/uaap.jpg" alt="UAAP"></a>
            <h3>UAAP Season 87 Men's Basketball Game 3</h3>
            <p>Venue: SM MALL OF ASIA ARENA</p>
            <p>December 14, 2024 | 2:00 PM</p>
            <a href="LOGGED-uaap_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        <div class="event">
            <a href="LOGGED-pvl_seating.php"><img src="images/pvl.jpg" alt="PVL"></a>
            <h3>PVL 2024-2025 All Filipino Conference</h3>
            <p>Venue: PHILSPORTS ARENA</p>
            <p>December 04, 2024</p>
            <a href="LOGGED-pvl_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        <div class="event">
            <a href="LOGGED-pfl_seating.php"><img src="images/pfl.jpg" alt="PFL"></a>
            <h3>Philippines Football League 2024-2025</h3>
            <p>Venue: RIZAL FOOTBALL STADIUM</p>
            <p>December 14, 2024</p>
            <a href="LOGGED-pfl_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        <div class="event">
            <a href="LOGGED-easl_seating.php"><img src="images/easl.jpg" alt="EASL"></a>
            <h3>EASL Manila 2024-25 Season</h3>
            <p>Venue: PHILSPORTS ARENA</p>
            <p>January 15, 2024</p>
            <a href="LOGGED-easl_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        
	
    </main>
    <footer>
        <p>&copy; 2024 EZ Tickets. All rights reserved.</p>
    </footer>
</body>
</html>