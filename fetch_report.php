<?php
// MySQL database connection details
$host = 'localhost';
$dbUsername = 'your_username';
$dbPassword = 'your_password';
$dbName = 'your_database_name';

// Create a connection
$connection = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

// Fetch the health report based on the provided email
$email = $_GET['email'];
$sql = "SELECT health_report FROM users WHERE email='$email'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $healthReportPath = $row['health_report'];

  // Output the health report file
  header("Content-type: application/pdf");
  header("Content-Disposition: inline; filename='health_report.pdf'");
  readfile($healthReportPath);
} else {
  echo "No health report found for the provided email.";
}

// Close the database connection
$connection->close();
?>
