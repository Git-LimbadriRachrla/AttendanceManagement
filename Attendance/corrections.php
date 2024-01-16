<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="download.ico">
    <title>Corrections Form</title>
    <link rel="stylesheet" type="text/css" href="Style1.css"/>
    <style>
        h2 {
            color: #007BFF;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
            color: #333;
        }
        button {
            background-color: #007BFF;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<nav>
        <h1>Curious Coders Club</h1>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="showingdata.php">ShowData </a></li>
            <li><a href="attendance.php">Attendance</a></li>
            <li><a href="insertingdata.php">NewStudent</a></li>
        </ul>
    </nav>
    <br><br><br><br>
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

    // Handle update and delete actions
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['search'])) {
            // Handle search
            $searchId = $_POST['search_id'];

            $searchSql = "SELECT * FROM Students3 WHERE id=$searchId";
            $searchResult = $conn->query($searchSql);

            if ($searchResult->num_rows > 0) {
                echo "<h2>Search Results</h2>";
                echo "<table>";
                echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Attendance</th><th>Action</th></tr>";

                while ($row = $searchResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["firstname"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["attendance"] . "</td>";
                    echo "<td>
                            <form method='post' style='display:inline-block;'>
                                <input type='hidden' name='update_id' value='" . $row["id"] . "'>
                                <label for='attribute_to_update'>Attribute to Update:</label>
                                <select name='attribute_to_update' required>
                                    <option value='firstname'>Name</option>
                                    <option value='email'>Email</option>
                                    <option value='attendance'>Attendance</option>
                                </select>
                                <input type='text' name='new_value' placeholder='New Value' required>
                                <button type='submit' name='update'>Update</button>
                            </form>
                            <form method='post' style='display:inline-block;'>
                                <input type='hidden' name='delete_id' value='" . $row["id"] . "'>
                                <button type='submit' name='delete'>Delete</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No user found with ID: $searchId</p>";
            }
        } elseif (isset($_POST['update']))
         {
            // Handle update
            $idToUpdate = $_POST['update_id'];
            $attributeToUpdate = $_POST['attribute_to_update'];
            $newValue = $_POST['new_value'];

            $newValue = htmlspecialchars($newValue);

            $updateSql = "UPDATE Students3 SET $attributeToUpdate='$newValue' WHERE id=$idToUpdate";

            if ($conn->query($updateSql) === TRUE) {
                echo "<p>Data updated successfully.</p>";
            } else {
                echo "<p class='error-message'>Error updating data: " . $conn->error . "</p>";
            }
        } elseif (isset($_POST['delete'])) {
            // Handle delete
            $idToDelete = $_POST['delete_id'];

            $deleteSql = "DELETE FROM Students3 WHERE id=$idToDelete";

            if ($conn->query($deleteSql) === TRUE) {
                echo "<p>Data deleted successfully.</p>";
            } else {
                echo "<p class='error-message'>Error deleting data: " . $conn->error . "</p>";
            }
        }
    }

    // Fetch existing data
    $result = $conn->query("SELECT * FROM Students3");
    $totalStudents = $result->num_rows-1; // Get total number of students
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="search_id">Search by ID:</label>
        <input type="text" name="search_id" required>
        <button type="submit" name="search">Search</button>
    </form>

    <?php
    if ($totalStudents > 0) {

        echo "<h2>Total Number of Students:$totalStudents</h2>";
    }

    $conn->close();
    ?>
</body>
</html>
