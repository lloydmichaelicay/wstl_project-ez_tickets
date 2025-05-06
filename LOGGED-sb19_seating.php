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
            <a href="db_logout.php" class="button">Logout</a>
        </div>
    </div>

    <main>

        <div class="container">
            <!-- Left Side - Seat Plan Image -->
            <div class="left">
                <img src="images/sb19_seatingg.png" alt="Arena Seat Plan">
            </div>

        <div class="right">
        <h2>SB19 Simula at Wakas World Tour</h2>
            <h3>June 01, 2025 | PHILIPPINE ARENA</h3>
            <br>
            <form action="db_seating.php" method="POST"> 
                <div class="form-group">
                    <label for="name">Event Name</label>
                    <select id="event_name" name="event_name" required>
                        <option>SB19 World Tour Philippines</option>
                    </select>
                </div>
                <div class="form-group">
                <label for="location">Section</label> 
                    <select id="location" name="seat_section" onchange="filterSections()" required>
                        <option value="" disabled selected hidden>Select Section</option> <!-- Faded default option -->
                        <option value="sb19-vip-standing-mosh" data-price="15000">VIP Standing Mosh Pit</option>
                        <option value="sb19-vip-standing" data-price="10500">VIP Standing</option>
                        <option value="sb19-vip-seating" data-price="11000">VIP Seating</option>
                        <option value="sb19-lba-p" data-price="7500">LBA Premium</option>
                        <option value="sb19-lba-r" data-price="6250">LBA Regular</option>
                        <option value="sb19-lbb-p" data-price="4750">LBB Premium</option>
                        <option value="sb19-lbb-r" data-price="3500">LBB Regular</option>
                        <option value="sb19-ub-a" data-price="2250">Upper Box A</option>
                        <option value="sb19-ubb-ga" data-price="1000">UBB / Gen Ad</option>
                    </select>
                </div>  
                <div class="form-group">
                    <label for="section">Section Number</label>
                    <select id="section" name="section_number" required>
                        <!-- Nasa JS na yung sections and will be shown dynamically -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity (5 tickets only per account)</label>
                    <input type="number" name="ticket_quantity" id="quantity" min="1" max="5" step="1" value="1" onchange="validateQuantity(); updatePrice()">
                </div>
                
                <div class="price-display">
                    Total Price: ₱<span id="total-price">0.00</span> + 2% Service Charge
                </div>
                <a href="">
                    <button class="btn">Reserve Tickets</button>
                </a>

                <!-- Hidden input to store calculated price -->
                <input type="hidden" id="calculated-price" name="total_price">
            </form>
        </div>
    </main>

    <script src="js/concert_seating.js"></script>
    <footer>
        <p>&copy; 2024 EZ Tickets. All rights reserved.</p>
    </footer>
</body>

</html>