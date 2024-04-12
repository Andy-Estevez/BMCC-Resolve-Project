<!-- Andy Estevez -->
<!-- BMCC Tech Innovation Hub Internship -->
<!-- Spring Semester 2024 -->
<!-- BMCC Resolve Project -->
<!-- Log Out Handler Page -->

<?php
    session_start();

    // If Student Logged In, Log Out
    if (isset($_SESSION["studentID"])) {
        unset($_SESSION["studentID"]);
    }

    // If Faculty Logged In, Log Out
    if (isset($_SESSION["facultyID"])) {
        unset($_SESSION["facultyID"]);
    }

    // Redirect To Landing Page
    header("Location: index.html");
    die;
?>