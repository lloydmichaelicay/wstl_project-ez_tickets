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
    <h1>UNIVERSITY-WIDE EVENTS</h1> 
    </div>
    <main>
        <div class="event">
            <a href="LOGGED-ncaa_seating.php"><img src="images/ncaaWhite.jpg" alt="sports"></a>
            <h3>NCAA 100 Volleyball</h3>
            <p>Venue: FILOIL ECOOIL CENTRE</p>
            <p>June 2025</p>
            <a href="LOGGED-ncaa_seating.php" class="buy-button">Buy Tickets</a> 
        </div>
        
        <div class="event"> 
            <a href="LOGGED-batingaw_seating.php"><img src="images/batingaw.jpg" alt="image"></a>
            <h3>Tanghalang Batingaw</h3>
            <p>Venue: JPL HALL OF FREEDOM</p>
            <p>June 21, 2025</p>
            <a href="LOGGED-batingaw_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        <div class="event">
            <a href="LOGGED-layasari_seating.php"><img src="images/layasari.jpg" alt="Kolohe Kai"></a>
            <h3>LPU Layasari Event</h3>
            <p>Venue: JPL HALL OF FREEDOM</p>
            <p>May 23, 2025</p>
            <a href="LOGGED-layasari_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        <div class="event"> 
            <a href="LOGGED-ldt_seating.php"><img src="images/ldt.jpg" alt="concert"></a>
            <h3>LPU Dance Troupe</h3>
            <p>Venue: JPL HALL OF FREEDOM</p>
            <p>May 31, 2025 | 7PM</p>
            <a href="LOGGED-ldt_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        <div class="event">
            <a href="LOGGED-nature.php"><img src="images/nature.png" alt="picture"></a>
            <h3>Our Nature, Our Future Fair</h3>
            <p>Venue: LPU Mini Theater</p> 
            <p>May 19-23, 2025</p>
            <a href="LOGGED-nature.php" class="buy-button">Buy Tickets</a>
        </div>

        
	
    </main>
    <footer>
        <p>&copy; 2025 EZ Tickets. All rights reserved.</p>
    </footer>
</body>
</html>