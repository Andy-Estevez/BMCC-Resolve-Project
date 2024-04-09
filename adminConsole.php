

// Connect to the database
<?php
    session_start();
    
    include("config.php");
    include("functions.php");
    
    $user_data = ($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Announcement</title>
</head>
<body>
    <h2>Send Announcement</h2>
    <form action="" method="POST">
        <label for=""></label><br>
        <input type="" id="" name="" required><br><br>

        <label for=""></label><br>
        <textarea id="" name="" rows="" cols="" required></textarea><br><br>

        <label for=""></label><br>
        <select id="" name="" required>
            <option value=""></option>
            <option value=""></option>
            <option value=""></option>
        </select><br><br>

        <input type="submit" value="Send Announcement">
    </form>
</body>
</html>




<?php

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ = $_POST[""];
    $ = $_POST[""];
    $ = $_POST[""];

    // Insert announcement into the database
    $sql = "INSERT INTO  () VALUES ('$', '$', '$ ')";
    if ($conn->query($sql) === TRUE) {
        echo "Announcement sent successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
