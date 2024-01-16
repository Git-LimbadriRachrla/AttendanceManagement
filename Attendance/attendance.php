<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="download.ico">
    <title>Attendeance Form</title>
    <link rel="stylesheet" type="text/css" href="Style1.css"/>
    <style>

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: linear-gradient(to right, #34e89e, #0f3443);
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
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

        .subAttendance {

            background-color: #4CAF50;
            /* Green */
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            border-radius: 5px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .subAttendance:hover {
            background-color: #45a049;
        }



    </style>
</head>

<body>
    <nav>
        <h1>Curious Coders Club</h1>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="corrections.php">corrections </a></li>
            <li><a href="showingdata.php">ShowData</a></li>
            <li><a href="insertingdata.php">NewStudent</a></li>
        </ul>
    </nav>
    <br><br><br><br><br>

    <h2>Tick For The Attendance</h2>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "firstdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    function updateAttendance($conn, $selectedIds)
    {
        foreach ($selectedIds as $id) {
            
            $conn->query("UPDATE Students3 SET attendance = attendance + 1 WHERE id = $id");
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        if (isset($_POST['attendance'])) {
            $selectedIds = $_POST['attendance'];

            updateAttendance($conn, $selectedIds);

            echo "Attendance updated successfully.<br>";
        } else {
            echo "No users selected for attendance.";
        }
    }

    $result = $conn->query("SELECT * FROM Students3");
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Attendance</th>
            </tr>

            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["firstname"] . "</td>
                        <td>
                        <input type='checkbox' name='attendance[]' value='" . $row["id"] . "'>
                        </td>
                      </tr>";
            }
            ?>
        </table>

        <button class="subAttendance" type="submit" name="submit">Submit Attendance</button>
    </form>

    <?php
    $conn->close();
    ?>
</body>

</html>