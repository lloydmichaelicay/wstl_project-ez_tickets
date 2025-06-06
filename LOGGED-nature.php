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
    <link rel="stylesheet" href="css/Cseating-styles.css">
</head>
<body>
    <header>
        <div class="logo-title-container">
            <div class="logo">
                <a href="index.html"><img src="images/logo.png" alt="EZ Tickets Logo"></a>
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
                <li><a href="https://www.facebook.com/philippineconcerts" target="_blank">News</a></li>
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
            <!-- Left Side - Seat Plan Image -->
            <div class="left">
                <img src="images/nature.png" alt="NFT Event Seat Plan">
            </div>

            <!-- Right Side - Seat Selection -->
            <div class="right">
                <h2>Our Nature, Our Future Fair</h2>
                <h3>May 19-23, 2025 | LPU Mini Theater</h3>
                <br>
                <form action="db_seating.php" method="POST">
                    
                    <div class="form-group">
                        <label for="name">Event Name</label>
                        <select id="event_name" name="event_name" required>
                            <option>CAS Sustainability Fair</option>
                        </select>
                    </div>
    
                    <div class="form-group">
                        <label for="location">Venue</label>
                        <select id="location" onchange="previewSections(); pricePreview();" required>
                            <option value="mini-theater" data-price="10">LPU Mini Theater</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="section">Seating</label>
                        <select id="section">
                            <!-- Nasa JS na yung sections and will be shown dynamically -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="ticket_quantity" id="quantity" min="1" max="5" step="1" value="1" onchange="validateQuantity(); updatePrice()">
                    </div>
                    
                    <div class="price-display">
                        Total Price: ₱<span id="total-price">0.00</span>
                    </div>
                    
                    <a href="https://forms.office.com/pages/responsepage.aspx?id=g2tMsVKft02aw8h58vXctAhJRcp__dZDvMh_MKS-Bw9UNlk5Q040OU9LRU1VV1lSM1BFV0NBNEE2Ti4u&route=shorturl&fbclid=IwY2xjawKc-5tleHRuA2FlbQIxMABicmlkETFORHpWSmg3OTU1T3JkZWx0AR7xfMNwDJF1XSEvj-q5Apwz6iCSmY6lkdXJvgLBokGYxFxsiEaRBcQFokMdbA_aem_aoHdAlub1qCCe26qORU2PQ" target="_blank">
                        <button class="btn">Continue to Registration</button>
                    </a>

                    <!-- Hidden input to store calculated price -->
                    <input type="hidden" id="calculated-price" name="total_price">
                </form>
            </div>
        </div>
    </main>

    <script src="js/concert_seating.js"></script>
    <footer>
        <p>&copy; 2024 EZ Tickets. All rights reserved.</p>
    </footer>
</body>
</html>
