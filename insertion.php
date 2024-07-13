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
    $aadhaar_id = $_POST['aadhaar_id'];
    $worker_id = $_POST['worker_id'];
    $worker_name = $_POST['worker_name'];
    $worker_phone = $_POST['worker_phone'];
    $job_id = $_POST['job_id'];
    $worker_designation = $_POST['worker_designation'];
    $department = $_POST['department'];
    $booking =$_POST['slot'];

    // Prepare SQL query
    $sql = "INSERT INTO workers (aadharid, workerid, workername, phoneno, jobid, designation, department ,booking) 
            VALUES ('$aadhaar_id', '$worker_id', '$worker_name', '$worker_phone', '$job_id', '$worker_designation', '$department' ,'$booking')";

    if ($conn->query($sql) === TRUE) {
        header("Location: allrecords.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
