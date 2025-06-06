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
    <link rel="stylesheet" href="css/Cseating-styles.css">
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

    <main>
 
        <div class="container">
            <!-- Left Side - Seat Plan Image -->
            <div class="left">
                <img src="images/filoil_seating.png" alt="Arena Seat Plan">
            </div>

        <div class="right">
            <h2>NCAA 100 Volleyball Game</h2>
            <h3>LPU vs Benilde (May 2025 | FILOIL ECOOIL CENTER)</h3>
            <br>
            <form action="db_seating.php" method="POST"> 
                <div class="form-group">
                    <label for="name">Event Name</label>
                    <select id="event_name" name="event_name" required>
                        <option>NCAA Volleyball LPU vs Benilde</option>
                    </select>
                </div>
            
                <div class="form-group">
                <label for="location">Section</label>
                    <select id="location" name="seat_section" onchange="filterSections()" required>
                        <option value="" disabled selected hidden>Select Location</option>
                        <option value="filoil-ringside-a" data-price="500">Ringside A</option>
                        <option value="filoil-ringside-b" data-price="500">Ringside B</option>
                        <option value="filoil-lower-box" data-price="200">Lowerbox</option>
                        <option value="filoil-upper-box" data-price="100">Upper Box</option>
                    </select>
                </div> 
                
                <div class="form-group">
                <label for="section">Section Number</label>
                    <select id="section" name="section_number" required>
                        <!-- Nasa JS na yung sections and will be shown dynamically -->
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="quantity">Quantity (Max. 2 tickets only)</label>
                    <input type="number" name="ticket_quantity" id="quantity" min="1" max="2" step="1" value="1" onchange="validateQuantity(); updatePrice()">
                </div>
                
                <div class="price-display">
                    Total Price: ₱<span id="total-price">0.00</span>
                </div>
                
                <a href=""> 
                    <button class="btn">Reserve Tickets</button>
                </a> 

                <!-- Hidden input to store calculated price -->
                <input type="hidden" id="calculated-price" name="total_price">
            </form> 
        </div>
    </main>

    <script src="js/sports_seating.js"></script>
    <footer>
        <p>&copy; 2025 EZ Tickets. All rights reserved.</p>
    </footer>
</body>

</html>