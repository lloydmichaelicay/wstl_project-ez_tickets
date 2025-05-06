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
    <h1>UPCOMING THEATRICAL EVENTS</h1>
    </div>
    <main>
        <div class="event">
            <a href="LOGGED-jepoy_seating.php"><img src="images/jepoy.jpg" alt="Jepoy"></a>
            <h3>Jepoy & The Magic Circle</h3>
            <p>Venue: EASTWOOD CITYWALK THEATER</p>
            <p>October - December 2024</p>
            <br>
            <a href="LOGGED-jepoy_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        <div class="event">
            <a href="LOGGED-tabilog_seating.php"><img src="images/tabilogp.jpg" alt="Tabing Ilog"></a>
            <h3>ABS-CBN Tabing Ilog The Musical</h3>
            <p>Venue: PETA THEATER CENTER</p>
            <p>December 01, 2024</p>
            <br>
            <a href="LOGGED-tabilog_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        <div class="event">
            <a href="LOGGED-ccp_seating.php"><img src="images/sandosapatos.jpg" alt="CCP"></a>
            <h3>Sandosenang Sapatos</h3>
            <p>Venue: CCP TANGHALANG IGNACIO GIMENEZ</p>
            <p>December 08, 2024</p>
            <br>
            <a href="LOGGED-ccp_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        <div class="event">
            <a href="LOGGED-nutc_seating.php"><img src="images/pbt.jpg" alt="Nutcraker"></a>
            <h3>Nutcraker by The Philippine Ballet Theater</h3>
            <p>Venue: SAMSUNG PERFORMING ARTS THEATER</p>
            <p>December 18, 2024</p>
            <a href="LOGGED-nutc_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        <div class="event">
            <a href="LOGGED-disney_seating.php"><img src="images/disney.jpg" alt="Disney"></a>
            <h3>Disney on Ice 2024: Find Your Hero</h3>
            <p>Venue: SM MALL OF ASIA ARENA</p>
            <p>December 21, 2024</p>
            <br>
            <a href="LOGGED-disney_seating.php" class="buy-button">Buy Tickets</a>
        </div>

        
    </main>
    <footer>
        <p>&copy; 2024 EZ Tickets. All rights reserved.</p>
    </footer>
</body>
</html>