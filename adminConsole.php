
<?php
    session_start();
    
    include("config.php");
    include("functions.php");
    
    $user_data = check_faculty_login($conn);
?>

<?php
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
   
        // NOTIFACATION//
// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $notificationID = $_POST["notificationID"];
    $facultyID = $_POST["facultyID"];
    $studentID = $_POST["studentID"];
    $classID = $_POST["classID"];
    $message = $_POST["Message"];
    $timestamp = $_POST["Timestamp"];
    $status = $_POST["Status"];

    // Insert data into the table
    $sql = "INSERT INTO notifications (notificationID, facultyID, studentID, classID, Message, Timestamp, Status) VALUES ('$notificationID', '$facultyID', '$studentID', '$classID', '$message', '$timestamp', '$status')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Announcement sent successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Send Announcement</title>
</head>
<body>
<!-- Header / Navigation Bar -->
<nav>
            <a href="https://www.bmcc.cuny.edu" target="_blank" onclick="return confirm('This will take you to the main BMCC page')">
                <img class="BMCCLogo" src="Elements\bmcc-logo-two-line-wide-WHITE.png" alt="BMCC Logo" height="50px">
            </a>
            <div class="NavButtonsContainer">
                <button type="button" class="navButton" onclick="location.href='facultyConsoleClasses.php'">Console</button>
                <button type="button" class="navButton" onclick="location.href='facultyProfile.php'">Profile</button>
                <button type="button" class="navButton" id="login" onclick="location.href='logout.php'">Log Out</button>
            </div>
        </nav>
          <div class="notification_form">
            <form method="post">
                <label for="notificationID">Notification ID:</label><br>
                <input type="text" id="notificationID" name="notificationID"><br>
                
                <label for="facultyID">Faculty ID:</label><br>
                <input type="text" id="facultyID" name="facultyID" placeholder="Enter faculty ID"><br>
                
                <label for="studentID">Student ID:</label><br>
                <input type="text" id="studentID" name="studentID"><br>
                
                <label for="classID">Class ID:</label><br>
                <input type="text" id="classID" name="classID"><br>
                
                <label for="Message">Message:</label><br>
                <textarea id="Message" name="Message" rows="4" cols="50"></textarea><br>
                
                <label for="Status">Status:</label><br>
                <input type="text" id="Status" name="Status"><br>
                
                <input type="submit" value="Send Announcement">
            </form>
            </div>

         <!-- Footer -->
         <footer>
            <a class="footerLink" href="https://maps.app.goo.gl/87HcM8tEhsrWe9wH6" target="_blank">
                <p class="footerText"><u>
                    Borough of Manhattan Community College <br>
                    The City University of New York <br>
                    199 Chambers Street <br>
                    New York, NY 10007
                </u></p>
            </a>
        </footer>

</body>
</html>




