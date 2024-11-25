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
            <a href="login.html" class="button">Logout</a>
        </div>
    </div>
    
    <div class="featured">
    <h1>UPCOMING CONCERTS</h1>
    </div>
    <main>
        <div class="event">
            <a href="LOGGED-bnb_seating.php"><img src="images/bnb.jpg" alt="Ben&Ben"></a>
            <h3>Ben&Ben T.T.A.D Concert</h3>
            <p>Venue: SM MALL OF ASIA ARENA</p>
            <p>December 14, 2024</p>
            <a href="LOGGED-bnb_seating.php" class="buy-button">Buy Tickets</a>
        </div>
        
        <div class="event">
            <a href="LOGGED-gv_seating.php"><img src="images/gv.png" alt="Gary V"></a>
            <h3>Gary V. One More Time</h3>
            <p>Venue: SMART ARANETA COLISEUM</p>
            <p>December 20 and 22, 2024</p>
            <a href="LOGGED-gv_seating.php" class="buy-button">Buy Tickets</a>
        </div>
 
        <div class="event">
            <a href="LOGGED-m5_seating.php"><img src="images/m5.jpg" alt="Maroon5"></a>
            <h3>Maroon 5 Asia Tour 2025</h3>
            <p>Venue: SM MALL OF ASIA ARENA</p>
            <p>January 29, 2025</p>
            <a href="LOGGED-m5_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        <div class="event">
            <a href="LOGGED-kk_seating.php"><img src="images/kk.jpg" alt="Kolohe Kai"></a>
            <h3>Kolohe Kai in Manila</h3>
            <p>Venue: SM AURA SAMSUNG HALL</p>
            <p>February 01, 2025</p>
            <a href="LOGGED-kk_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        <div class="event">
            <a href="LOGGED-ts_seating.php"><img src="images/ts.jpg" alt="The Script"></a>
            <h3>The Script World Tour</h3>
            <p>Venue: SMART ARANETA COLISEUM</p>
            <p>February 11 and 12, 2025</p>
            <a href="LOGGED-ts_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        
	
    </main>
    <footer>
        <p>&copy; 2024 EZ Tickets. All rights reserved.</p>
    </footer>
</body>
</html>