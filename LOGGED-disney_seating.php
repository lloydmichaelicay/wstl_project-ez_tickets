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
            <a href="index.html" class="button">Logout</a>
        </div>
    </div>
 
    <main>

        <div class="container">
            <!-- Left Side - Seat Plan Image -->
            <div class="left">
                <img src="images/disney_seating.png" alt="Arena Seat Plan">
            </div>
 
        <div class="right">
            <h2>Disney on Ice 2024: Find Your Hero</h2>
            <h3>December 21, 2024 | SM MALL OF ASIA ARENA</h3>
            <br>
            <div class="form-group">
                <label for="location">Section</label>
                <select id="location" onchange="filterSections()" required>
                    <option value="" disabled selected hidden>Select Section</option> <!-- Faded default option -->
                    <option value="disney-front-row" data-price="5400">Front Row</option>
                    <option value="disney-svip" data-price="4200">SVIP</option>
                    <option value="disney-vip" data-price="3400">VIP</option>
                    <option value="disney-lb-center" data-price="2600">Lowerbox Center</option>
                    <option value="disney-lb-premium" data-price="2200">Lowerbox Premium</option>
                    <option value="disney-lb-regular" data-price="2000">Lowerbox Regular</option>
                    <option value="disney-ub-center" data-price="1000">Upper Box Center</option>
                    <option value="disney-ub-regular" data-price="800">Upper Box Regular</option>
                    <option value="disney-general-admission" data-price="300">General Admission</option>
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

    <script src="js/theater_seating.js"></script>
    <footer>
        <p>&copy; 2024 EZ Tickets. All rights reserved.</p>
    </footer>
</body>

</html>