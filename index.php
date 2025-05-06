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
    <title>Login Home</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header>
    <div class="logo-title-container">
        <div class="logo">
            <a href="index.php"><img src="images/logo.png" alt="EZ Tickets Logo"></a>
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
            <a href="db_logout.php" class="button">Logout</a>
        </div>
    </div>
  
    <div class="featured">
    <h1>FEATURED EVENTS</h1>
    </div>
    <main> 
        <div class="homep">
            <a href="LOGGED-ncaa_seating.php"><img src="images/ncaaV.png" alt="sports"></a>
            <h3>NCAA Season 100 Volleyball</h3>
            <p>Venue: FilOil EcoOil Center, San Juan City</p>
            <p>Get ready for the 2nd round of the NCAA 100 Volleyball!</p>
            <p>Date: April 29 - May 04, 2025</p>
            <a href="LOGGED-ncaa_seating.php" class="buy-button">Buy Tickets</a>
        </div>
 
        <div class="homep">
            <a href="LOGGED-sb19_seating.php"><img src="images/sb19.jpg" alt="concert"></a>
            <h3>Simula at Wakas World Tour Philippines</h3>
            <p>Venue: Philippine Arena, Bocaue, Bulacan</p>
            <p>SB19 is set to push the boundaries of P-pop to the World.</p>
            <p>Date: May 31 - June 01, 2025</p>
            <a href="LOGGED-sb19_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        <div class="homep">
            <a href="LOGGED-jokoy_seating.php"><img src="images/jokoy.jpg" alt="theater"></a>
            <h3>Jo Koy Just being Koy Manila</h3>
            <p>Venue: SM Mall of Asia Arena, Pasay City</p>
            <p>Jo Koy is one of 2024's top 10 grossing stand-up comedians!</p>
            <p>Date: June 21, 2025</p>
            <a href="LOGGED-jokoy_seating.php" class="buy-button">Buy Tickets</a>
        </div>
		<div class="ads">
            &ensp;Advertisements
            <div>
                <h3>Music</h3>
                <p>Coachella 2025 was a success!</p>
				<a href="https://pitchfork.com/topics/coachella/" target="_blank" class="buy-button">See more</a>
            </div>
            <div>
                <h3>Beauty and Brains</h3>
                <p>Ahtisa Manalo wins Miss Universe PH 2025</p>
				<a href="https://www.philstar.com/entertainment/2025/05/04/2440319/ahtisa-manalo-falls-then-rises-win-muph-2025-crown" target="_blank" class="buy-button">See more</a>
            </div>
            <div>
                <h3>His Eminence</h3>
                <p>Remembering the Legacy of Pope Francis</p>
				<a href="https://www.vaticannews.va/en/pope/news/2025-04/pope-sculpure-late-pope-francis-interview-timothy-schmalz.html" target="_blank" class="buy-button">See more</a>
            </div>
        </div>
    </div>
    </main>
    <footer>
        <p>&copy; 2025 EZ Tickets. All rights reserved.</p>
    </footer>
</body>
</html>