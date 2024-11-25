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
    <h1>EVENT VENUES</h1>
    </div>
    <main>
        <div class="venues">
            <img src="images/moa.jpg" alt="MOA Arena">
            <h3>SM Mall of Asia Arena</h3>
            <a href="https://www.mallofasia-arena.com" target="_blank" class="buy-button">Visit Site</a>
            <br><br><br><br><br>
            <img src="images/sm.jpg" alt="Araneta">
            <h3>Other SM Event Venues</h3>
            <a href="https://mallsvenue.boomtech.co/venues" target="_blank" class="buy-button">Visit Site</a>
        </div>

        <div class="venues">
            <img src="images/araneta.jpg" alt="Araneta">
            <h3>Smart Araneta Coliseum</h3>
            <a href="https://smartaranetacoliseum.com" target="_blank" class="buy-button">Visit Site</a>
            <br><br><br><br><br>
                <img src="images/samsung.jpg" alt="Circuit">
                <h3>Samsung Performing Arts Theater</h3>
                <a href="https://www.circuitperformingartstheater.com/" target="_blank" class="buy-button">Visit Site</a>
        </div>

        <div class="venues">
            <img src="images/pha.png" alt="PH Arena">
            <h3>Philippine Arena</h3>
            <br>
            <a href="https://www.facebook.com/OfficialPhilippineArena/" target="_blank" class="buy-button">Visit Site</a>
            <br><br><br><br><br>
            <img src="images/newport.jpg" alt="Newport">
            <h3>Newport Performing Arts Theater</h3>
            <a href="https://www.newportworldresorts.com/mall/newport-performing-arts-theater" target="_blank" class="buy-button">Visit Site</a>
        </div>

        <div class="venues">
            <img src="images/filoil.jpg" alt="Filoil">
            <h3>FilOil EcoOil Centre</h3>
            <br>
            <a href="https://www.facebook.com/filoilflyingvcentre/" target="_blank" class="buy-button">Visit Site</a>
            <br><br><br><br><br>
            <img src="images/peta.png" alt="PETA">
            <h3>PETA Theater Center</h3>
            <br>
            <a href="https://petatheater.com" target="_blank" class="buy-button">Visit Site</a>
        </div>

        <div class="venues">
            <img src="images/nft.jpg" alt="New Frontier">
            <h3>New Frontier Theater</h3>
            <br>
            <a href="https://newfrontiertheater.com" target="_blank" class="buy-button">Visit Site</a>
            <br><br><br><br><br>
            <img src="images/ynares.jpg" alt="Ynares">
            <h3>Ynares Sports Arena Pasig | Antipolo</h3>
            <a href="https://en.wikipedia.org/wiki/Ynares_Sports_Arena" target="_blank" class="buy-button">Visit Site</a>
        </div>
    
        <div class="venues">
            <img src="images/ccp.png" alt="CCP">
            <h3>Cultural Center of the Philippines</h3>
            <a href="https://culturalcenter.gov.ph/events/category/theater/list/" target="_blank" class="buy-button">Visit Site</a>
            <br><br><br><br><br>
            <img src="images/psc.jpg" alt="PSC">
            <h3>Philippine Sports Commission Venues</h3>
            <a href="https://psc.gov.ph/psc_site/facilities-and-venues/" target="_blank" class="buy-button">Visit Site</a>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 EZ Tickets. All rights reserved.</p>
    </footer>
</body>
</html>