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
    <title>EZ Tickets Home</title>
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
            <li><a href="">Contact Us</a></li>
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
            <a href="index.html" class="button">Logout</a>
        </div>
    </div>
  
    <div class="featured">
    <h1>FEATURED EVENTS</h1>
    </div>
    <main>
        <div class="homep">
            <a href="LOGGED-ncaa_seating.php"><img src="images/sportss.jpg" alt="NCAA"></a>
            <h3>NCAA Season 100 Basketball</h3>
            <p>Venue: FILOIL ECOOIL CENTRE, San Juan City</p>
            <p>CSB Blazers vs. Mapua Cardinals</p>
            <p>November 30, 2024 | 12:00 PM</p>
            <a href="LOGGED-ncaa_seating.php" class="buy-button">Buy Tickets</a>
        </div>
 
        <div class="homep">
            <a href="LOGGED-m5_seating.php"><img src="images/m5.jpg" alt="Maroon5"></a>
            <h3>Maroon 5 Asia Tour 2025</h3>
            <p>Venue: SM MALL OF ASIA ARENA, Pasay City</p>
            <p>We're excited to be heading back to Asia in early 2025!</p>
            <p>January 29, 2025</p>
            <a href="LOGGED-m5_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        <div class="homep">
            <a href="LOGGED-tabilog_seating.php"><img src="images/tabilogp.jpg" alt="Tabing Ilog"></a>
            <h3>ABS-CBN Tabing Ilog The Musical</h3>
            <p>Venue: PETA THEATER CENTER, Quezon City</p>
            <p>Sa ilog, muli tayong magtatampisaw kasama ang barkada!</p>
            <p>November - December, 2024</p>
            <a href="LOGGED-tabilog_seating.php" class="buy-button">Buy Tickets</a>
        </div>
		<div class="ads">
            &ensp;Advertisements
            <div>
                <h3>Rap</h3>
                <p>Hev Abi on repeat</p>
				<a href="https://open.spotify.com/artist/4zpGxqF6oI1h3f6Md2v42T?si=6CMYwRmgT2G6XVsIIrYVRg" target="_blank" class="buy-button">See more</a>
            </div>
            <div>
                <h3>Story Untold</h3>
                <p>Hello, Love, Again. NOW SHOWING Nationwide</p>
				<a href="https://news.abs-cbn.com/entertainment/2024/11/12/look-celebs-attend-hello-love-again-world-premiere-749" target="_blank" class="buy-button">See more</a>
            </div>
            <div>
                <h3>Breaking Barriers</h3>
                <p>2024 is indeed the year of BINI</p>
				<a href="https://www.facebook.com/share/p/CEgqCuMEYA7GCzqK/" target="_blank" class="buy-button">See more</a>
            </div>
        </div>
    </div>
    </main>
    <footer>
        <p>&copy; 2024 EZ Tickets. All rights reserved. Special thanks to BEYONCE.</p>
    </footer>
</body>
</html>