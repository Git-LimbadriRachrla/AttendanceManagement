<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="icon" type="image/x-icon" href="download.ico">
    <link rel="stylesheet" type="text/css" href="Style1.css"/>
    <style>

        h2 {
            color: #216869;
            text-align: center;
            margin-top: 70px;
        }

        form {
            background: linear-gradient(to right, #34e89e, #0f3443);
            
            color: #f8f8f8;
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            /* background-color: #f8f8f8; */
            background-color:lightgrey;
            color:black;
            font-size: larger;
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

        p {
            color: #007BFF;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<nav>
        <h1>Curious Coders Club</h1>
        <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="showingdata.php">Data</a></li>
        <li><a href="corrections.php">Corrections </a></li>
        <li><a href="attendance.php">Attendance</a></li>   
        </ul>
    </nav><br><br><br>

    <h2>New Member Details</h2>

    <?php
    // PHP code remains unchanged
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "firstdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $errorMessage = "";  // Initialize error message variable
    $successMessage = ""; // Initialize success message variable

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $id = $_POST["id"];
        $name = $_POST["firstname"];
        $email = $_POST["email"];
        $attendance = $_POST["attendance"]; // Added attendance input

        $name = htmlspecialchars($name);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // Check if ID already exists
        $checkIdQuery = "SELECT id FROM Students3 WHERE id = '$id'";
        $result = $conn->query($checkIdQuery);

        if ($result->num_rows > 0) {
            $errorMessage = "ID already exists. Please choose a different ID.";
        } else {
            // Insert data into the database
            $sql = "INSERT INTO Students3(id, firstname, email, attendance) VALUES ('$id', '$name', '$email', '$attendance')";

            if ($conn->query($sql) === TRUE) {
                $successMessage = "Data successfully added to the database.";
            } else {
                $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    ?>

    <form id="userForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="id">ID:</label>
        <input type="text" name="id" required>

        <label for="firstname">Name:</label>
        <input type="text" name="firstname" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="attendance">Attendance:</label>
        <input type="text" name="attendance" required>

        <button type="submit" name="submit">Submit</button>
    </form>

    <!-- Display error and success messages -->
    <p style='color: red;'><?php echo $errorMessage; ?></p>
    <p style='color: green;'><?php echo $successMessage; ?></p>

    <?php
    // PHP code remains unchanged
    $conn->close();
    ?>
</body>

</html>
