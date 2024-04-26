<!-- Andy Estevez / Smedly Moise -->
<!-- BMCC Tech Innovation Hub Internship -->
<!-- Spring Semester 2024 -->
<!-- BMCC Resolve Project -->
<!-- Assignment Submission Handler -->

<?php
    // PHP / Data Set Up
    session_start();

    include("config.php");
    include("functions.php");

    $user_data = check_student_login($conn);
    $assignmentID = $_GET["aID"];
    $classID = $_GET["cID"];

    // Update Assignment Status
    $updateQuery = "UPDATE stutoassignmentmap 
                    SET completionStatus = 1 
                    WHERE assignmentID = $assignmentID AND studentID = $user_data[studentID];";

    // Verify Query Successful
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: studentClass.php?cID=$classID");
    } else {
        die("ERROR: Failed to turn in assignment.");
    }
?>