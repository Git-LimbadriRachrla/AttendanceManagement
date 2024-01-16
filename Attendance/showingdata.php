<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <link rel="icon" type="image/x-icon" href="download.ico">
    <link rel="stylesheet" type="text/css" href="Style1.css"/>
    <style>

        h2 {
            color: #216869;
            text-align: center;
            margin-top: 70px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: linear-gradient(to right, #34e89e, #0f3443);
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #216869;
            color: #f8f8f8;
        }

        tr:hover {
            background-color: #2c7d63;
        }

        .important-cell {
            font-weight: bold;
            color: #e44d26;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>

    <nav>
        <h1>Curious Coders Club</h1>
        <ul>
        <li><a href="index.html">Home</a></li>
            <li><a href="corrections.php">Corrections </a></li>
            <li><a href="attendance.php">Attendance</a></li>
            <li><a href="insertingdata.php">NewStudent</a></li>
        </ul>
    </nav>
    <br><br>
    <h2>User Information</h2>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "firstdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT * FROM Students3");
    // Get total number of students
    $totalStudents = $result->num_rows;
    ?>

    <?php
    if ($totalStudents > 0) {
        $totalStudents -= 1;
        echo "<h2>Total Number of Students: $totalStudents</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Attendance</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["firstname"] . "</td><td>" . $row["email"] . "</td><td>" . $row["attendance"] . "</td></tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No users found in the database.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
