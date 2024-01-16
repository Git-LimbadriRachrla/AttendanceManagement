<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="download.ico">
  <title>Creating Database</title>
</head>
<body>
  
<?php
$servername ="localhost";
$username ="root";
$password ="root";


$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE firstdb";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} 
else 
{
  echo "Error creating database: " . $conn->error;
}

$conn->close();
?>
</body>
</html>