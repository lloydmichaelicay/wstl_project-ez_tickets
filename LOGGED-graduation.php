<?php
session_start();
if (!isset($_SESSION['id'])) {
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
    <title>LPU Graduation 2025</title> 
    <link rel="stylesheet" href="css/Cseating-styles.css">
</head>
<body>
<header>
    <div class="logo-title-container">
        <div class="logo">
            <a href="index.html"><img src="images/logo.png" alt="EZ Tickets Logo"></a>
        </div>
        <div class="title"><b>LPU EZ Events</b></div>
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

<main>
    <div class="container">
        <div class="left">
            <img src="images/marriottGB.jpg" alt="Seating Plan">
        </div>

        <div class="right">
            <h2>LPU Graduation Class of 2025</h2>
            <h3>September 29, 2025 | Grand Ballroom, Marriott Hotel</h3>
            <br>

            <form action="db_seating.php" method="POST">
                
            <div class="form-group">
                    <label for="name">Session</label>
                    <select id="event_name" name="event_name" required>
                        <option>LPU Graduation 2025 AM Session (8:00 AM)</option>
                        <option>LPU Graduation 2025 PM Session (1:00 PM)</option>
                    </select>
                </div>
            
                <div class="form-group">
                <label for="location">Venue</label> 
                    <select id="location" name="seat_section" onchange="filterSections()" required>
                        <option value="" disabled selected hidden>Select Seating</option> <!-- Faded default option -->
                        <option value="marriott-gold" data-price="500">Marriott Gold Section</option>
                        <option value="marriott-silver" data-price="350">Marriott Silver Section</option>
                    </select>
                </div>  
                
                <div class="form-group">
                    <label for="section">Seating</label>
                    <select id="section" name="section_number" required>
                        <!-- Nasa JS na yung sections and will be shown dynamically -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity (Max. 2 Tickets only)</label> 
                    <input type="number" name="ticket_quantity" id="quantity" min="1" max="2" step="1" value="1" onchange="validateQuantity(); updatePrice()">
                </div>

                <div class="price-display">
                    Total Price: ₱<span id="total-price">0.00</span>
                </div>

                <input type="hidden" name="total_price" id="calculated-price">

                <button type="submit" class="btn">Reserve Tickets</button>
            </form>
        </div>
    </div>
</main>

<script src="js/theater_seating.js"></script>
<footer>
    <p>&copy; 2025 EZ Tickets. All rights reserved.</p>
</footer>
</body>
</html>
