<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "steelplant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all records from workers table
$sql = "SELECT workername, workerid, department,booking FROM workers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked Time Slots</title>
    <link rel="stylesheet" href="booking.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.jpg" alt="Logo">
        </div>
        <nav>
            <a href="/page.html">Registration</a>
            <a href="/login.html"><u>Your Bookings</u></a>
        </nav>
    </header>
    <main>
        <h1>Booked Time Slots</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Worker ID</th>
                    <!-- <th>Booking Time</th> -->
                    <th>Department</th>
                    <th>Booking Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['workername']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['workerid']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['department']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['booking']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No records found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
