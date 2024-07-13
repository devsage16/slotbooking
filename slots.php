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

// Fetch available slots
$sql = "SELECT * FROM slots WHERE available = TRUE";
$result = $conn->query($sql);

$slots = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $slots[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safety Training Slot Booking Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="page.css">
</head>
<body>
    <!-- Previous code here -->

    <section class="slot-selection">
        <h2>Select Slot</h2>
        <div class="wrapper">
            <header>
                <p class="current-date"></p>
                <div class="icons">
                    <span id="prev" class="material-symbols-rounded"><i class="fa-solid fa-chevron-left"></i></span>
                    <span id="next" class="material-symbols-rounded"><i class="fa-solid fa-chevron-right"></i></span>
                </div>
            </header>
            <div class="calendar">
                <ul class="weeks">
                    <li>Sun</li>
                    <li>Mon</li>
                    <li>Tue</li>
                    <li>Wed</li>
                    <li>Thu</li>
                    <li>Fri</li>
                    <li>Sat</li>
                </ul>
                <ul class="days">
                    <?php foreach ($slots as $slot): ?>
                        <li data-date="<?php echo $slot['date']; ?>" data-time="<?php echo $slot['time_slot']; ?>">
                            <?php echo $slot['date'] . " - " . $slot['time_slot']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <button type="button" id="book-slot-btn">Book Slot</button>
    </section>

    <script>
        document.getElementById('book-slot-btn').addEventListener('click', function() {
            var selectedSlot = document.querySelector('.days li.selected');
            if (selectedSlot) {
                var date = selectedSlot.getAttribute('data-date');
                var time = selectedSlot.getAttribute('data-time');

                // Send the selected slot to the server
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'book_slot.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        alert('Slot booked successfully!');
                    } else {
                        alert('Error booking slot.');
                    }
                };
                xhr.send('date=' + date + '&time=' + time);
            } else {
                alert('Please select a slot first.');
            }
        });

        document.querySelectorAll('.days li').forEach(function(slot) {
            slot.addEventListener('click', function() {
                document.querySelectorAll('.days li').forEach(function(s) {
                    s.classList.remove('selected');
                });
                slot.classList.add('selected');
            });
        });
    </script>
</body>
</html>
