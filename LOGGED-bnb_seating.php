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
    <link rel="stylesheet" href="css/Cseating-styles.css">
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
            <a href="login.html" class="button">Logout</a>
        </div>
    </div>

    <main>

        <div class="container">
            <!-- Left Side - Seat Plan Image -->
            <div class="left">
                <img src="images/bnb_seating.jpg" alt="Arena Seat Plan">
            </div>

        <div class="right">
            <h2>The Traveller Across Dimensions</h2>
            <h3>December 14, 2024 | SM MALL OF ASIA ARENA</h3>
            <br> 
            <div class="form-group">
                <label for="location">Section</label>
                <select id="location" onchange="filterSections()" required>
                    <option value="" disabled selected hidden>Select Section</option> <!-- Faded default option -->
                    <option value="bnb-standing" data-price="7700">Liwanag VIP Package</option>
                    <option value="bnb-standing" data-price="3200">Liwanag Standing</option>
                    <option value="bnb-lower-box-p" data-price="7700">Lower Box Premium</option>
                    <option value="bnb-lower-box-a" data-price="4700">Lower Box A</option>
                    <option value="bnb-lower-box-b" data-price="3700">Lower Box B</option>
                    <option value="bnb-upper-box" data-price="2700">Upper Box</option>
                    <option value="bnb-general-admission" data-price="1700">General Admission</option>
                </select>
            </div>
            <div class="form-group">
                <label for="section">Section Number</label>
                <select id="section" required>
                     <!-- Nasa JS na yung sections and will be shown dynamically -->
                </select>
            </div>
            
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" min="1" max="5" step="1" value="1" onchange="validateQuantity(); updatePrice()">
            </div>
            
            <div class="price-display">
                Total Price: ₱<span id="total-price">0.00</span>
            </div>
            <a href="">
                <button class="btn">Proceed to Checkout</button>
            </a>
        </div>
    </main>

    <script src="js/concert_seating.js"></script>
    <footer>
        <p>&copy; 2024 EZ Tickets. All rights reserved.</p>
    </footer>
</body>

</html>