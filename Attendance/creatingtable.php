<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="download.ico">
  <title>Creating Table</title>
</head>
<body>
  <?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "firstdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE Students3 (
id INT(6) UNSIGNED  PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
email VARCHAR(50),
attendance INT
)";

if ($conn->query($sql) === TRUE) {
  echo "Table Students3 created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
</body>
</html>