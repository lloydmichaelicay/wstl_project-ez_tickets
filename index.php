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
            <a href="index.php"><img src="images/logo.png" alt="EZ Tickets Logo"></a>
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
  
    <div class="featured">
    <h1>FEATURED EVENTS</h1>
    </div>
    <main> 
        <div class="homep">
            <a href="LOGGED-ncaa_seating.php"><img src="images/ncaaB.jpg" alt="sports"></a>
            <h3>NCAA Season 100 Volleyball</h3>
            <p>Venue: FilOil EcoOil Center, San Juan City</p>
            <p>Get ready for the Final Four Action of the NCAA 100 Volleyball!</p>
            <p>Date: June 2025</p>
            <a href="LOGGED-ncaa_seating.php" class="buy-button">Reserve Tickets</a>
        </div>

        <div class="homep">
            <a href="LOGGED-batingaw_seating.php"><img src="images/batingaw.jpg" alt="concert"></a>
            <h3>Tanghalang Batingaw Year Ender Show</h3>
            <p>Venue: 3rd Floor, JPL Hall of Freedom</p>
            <p>Sustaining our Future by Uniting Knowledge.</p>
            <p>Date: June 20-21, 2025</p>
            <a href="LOGGED-batingaw_seating.php" class="buy-button">Reserve Tickets</a>
        </div>

        <div class="homep">
            <a href="LOGGED-ldt_seating.php"><img src="images/ldtm.png" alt="theater"></a>
            <h3>LDT Goes OPM: A Dance Concert</h3>
            <p>Venue: 3rd Floor, JPL Hall of Freedom</p>
            <p>This is a heartfelt tribute to Original Pilipino Music.</p>
            <p>Date: May 24, 2025</p>
            <a href="LOGGED-ldt_seating.php" class="buy-button">Reserve Tickets</a>
        </div>

		<div class="ads">
            &ensp;Advertisements
            <div>
                <h3>Habemus Papam!</h3>
                <p>Pope Leo XVI is the 267th Bishop of Rome.</p>
				<a href="https://www.vaticannews.va/en/pope/news/2025-05/cardinal-elected-pope-papal-name.html" target="_blank" class="buy-button">See more</a>
            </div>
            
            <div>
                <h3>Music</h3>
                <p>BLACKPINK Comeback this 2025!</p>
				<a href="https://www.facebook.com/philippineconcerts/posts/blackpink-is-coming-back-to-the-philippine-arena-for-the-deadline-in-bulacan-on-/1254080216111088/" target="_blank" class="buy-button">See more</a>
            </div>
            
            <div>
                <h3>Beauty and Brains</h3>
                <p>Ahtisa Manalo wins Miss Universe PH 2025</p>
				<a href="https://www.philstar.com/entertainment/2025/05/04/2440319/ahtisa-manalo-falls-then-rises-win-muph-2025-crown" target="_blank" class="buy-button">See more</a>
            </div>
            
        </div>
    </div>
    </main>
    <footer>
        <p>&copy; 2025 EZ Tickets. All rights reserved.</p>
    </footer>
</body>
</html>