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
            <a href="login.html" class="button">Logout</a>
        </div>
    </div>

    <main>
        <div class="container">

            <div class="left">
                <img src="images/moaB_seating.jpg" alt="Arena Seat Plan">
            </div>
 
            <div class="right">
                <h2>UAAP 87 Men's Basketball Finals</h2>
                <h3>November 30, 2024 | SM MALL OF ASIA ARENA</h3>
                <br>
                 
                <div class="form-group">
                    <label for="location">Section</label>
                    <select id="location" onchange="filterSections()" required>
                        <option value="" disabled selected hidden>Select Section</option> <!-- Faded default option -->
                        <option value="moa-courtside" data-price="550">Courtside</option>
                        <option value="moa-patron" data-price="400">Patron</option>
                        <option value="moa-lower-box-a" data-price="300">Lower Box A</option>
                        <option value="moa-lower-box-b" data-price="200">Lower Box B</option>
                        <option value="moa-upper-box" data-price="100">Upper Box</option>
                        <option value="moa-general-admission" data-price="50">General Admission</option>
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
        </div> 
    </main>
    <script src="js/sports_seating.js"></script>

    <footer> 
        <p>&copy; 2024 EZ Tickets. All rights reserved.</p>
    </footer>
</body>
</html>