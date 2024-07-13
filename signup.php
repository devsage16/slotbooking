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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $workerName = $_POST['workerName'];
    $aadhaarNumber = $_POST['aadhaarNumber'];
    $phoneNumber = $_POST['phoneNumber'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL query
    $sql = "INSERT INTO users (aadhaar_number, password, created_at, name) VALUES (?, ?, NOW(),?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $aadhaarNumber, $hashed_password,$workerName);

    if ($stmt->execute()) {
        echo "New user created successfully";
        header("Location: login.php");
        exit(); 
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
