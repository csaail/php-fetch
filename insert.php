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

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $age = $_POST['age'];
  $weight = $_POST['weight'];
  $email = $_POST['email'];
  $healthReport = $_FILES['healthReport'];

  // Move the uploaded file to a desired location
  $uploadPath = 'uploads/' . basename($healthReport['name']);
  move_uploaded_file($healthReport['tmp_name'], $uploadPath);

  // Insert user details and file path into the database
  $sql = "INSERT INTO users (name, age, weight, email, health_report) VALUES ('$name', '$age', '$weight', '$email', '$uploadPath')";
  if ($connection->query($sql) === TRUE) {
    echo "User details inserted successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . $connection->error;
  }
}

// Close the database connection
$connection->close();
?>
