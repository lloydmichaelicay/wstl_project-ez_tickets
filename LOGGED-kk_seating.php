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
                <a href="index.html"><img src="images/logo.png" alt="EZ Tickets Logo"></a>
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
                <img src="images/samsungaura_seating.png" alt="Arena Seat Plan">
            </div>

        <div class="right">
            <h2>Kolohe Kai in Manila</h2>
            <h3>February 01, 2025 | SM AURA SAMSUNG HALL</h3>
            <br>
            <div class="form-group">
                <label for="location">Section</label>
                <select id="location" onchange="filterSections()" required>
                    <option value="aura-main-floor" data-price="3160">Main Floor</option>
                    <option value="aura-balcony" data-price="2650">Balcony</option>
                </select>
            </div>
            <div class="form-group">
                <label for="section">Row</label>
                <select id="section">
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