<?php
session_start();

// INSERT INTO ticket_inventory (event_name, total_tickets, tickets_left)
// VALUES ('title', 5500, 5500);

$conn = new mysqli('localhost', 'root', '', 'ez_tickets');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = " 
    SELECT 
        ti.event_name,
        ti.total_tickets,
        IFNULL(SUM(us.ticket_quantity), 0) AS tickets_sold,
        (ti.total_tickets - IFNULL(SUM(us.ticket_quantity), 0)) AS tickets_remaining
    FROM ticket_inventory ti
    LEFT JOIN user_seating us 
        ON us.event_name = ti.event_name
    GROUP BY ti.event_name, ti.total_tickets
    ORDER BY ti.event_name ASC;
";
 

$result = $conn->query($sql);
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LPU Events Admin</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header> 
        <div class="logo-title-container">
            <div class="logo">
                <a href="index.html"><img src="images/logo.png" alt="EZ Tickets Logo"></a>
            </div>
            <div class="title">
                <b>LPU Events</b>
            </div>
        </div>  
            <h2 style="color:#ddd">Ticket Inventory Dashboard</h2>
        <nav>
            <ul> 
                <li><a href="index.html" target="_blank">Home</a></li>
                <li><a href="login.html" target="_blank">Login/Signup</a></li>
            </ul>
        </nav>
    </header> 
    
    <h3 style="text-align:center;">Refreshes every 2 mins.</h3>
    <table>
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Total Tickets</th>
                <th>Reserved Tickets</th>
                <th>Tickets Remaining</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                    <td><?php echo $row['total_tickets']; ?></td>
                    <td><?php echo $row['tickets_sold']; ?></td>
                    <td><?php echo $row['tickets_remaining']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
