<!DOCTYPE html>

<!-- Andy Estevez / Smedly Moise -->
<!-- BMCC Tech Innovation Hub Internship -->
<!-- Spring Semester 2024 -->
<!-- BMCC Resolve Project -->
<!-- Faculty Console (Classes) Page -->

<?php
    // PHP / Data Set Up
    session_start();
    
    include("config.php");
    include("functions.php");
    
    $user_data = check_faculty_login($conn);

    // When Add Class Form Is Submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $className = $_POST["className"];
        $classSection = $_POST["classSection"];
        $classSemester = $_POST["classSemester"];

        // Verify Inputs Not Empty
        if (!empty($className) && !empty($classSection) && !empty($classSemester)) {
            // Create New Class Entry
            $query = "INSERT INTO Classes (Classes.facultyID, Classes.name, Classes.section, Classes.semester)
                      VALUES ('$user_data[facultyID]', '$className', '$classSection', '$classSemester')";

            // Verify Query Successful
            if (mysqli_query($conn, $query)) {
                header("Location: facultyConsoleClasses.php");
                die;
            } else {
                die("ERROR: Class creation failed.");
            }
        }
        else {
            // Handle Empty Inputs Here
        }
    }
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>BMCC Resolve | Faculty Console</title>
    </head>

    <body>
        <!-- Header / Navigation Bar -->
        <nav>
            <!-- Logo -->
            <a href="facultyHome.php">
                <img class="BMCCLogo" src="Elements\bmcc-logo-resolve.png" alt="BMCC Logo" height="50px">
            </a>

            <!-- Buttons -->
            <div class="NavButtonsContainer">
                <button type="button" class="navButton" onclick="location.href='facultyHome.php'">Home</button>
                <button type="button" class="navButton" onclick="location.href='facultyConsoleClasses.php'">Console</button>
                <button type="button" class="navButton" onclick="location.href='facultyProfile.php'">Profile</button>
                <button type="button" class="navButton" id="login" onclick="location.href='logout.php'">Log Out</button>
            </div>
        </nav>

        <!------------->
        <!-- Content -->
        <!------------->

        <!-- Class List -->
        <div class="classesBlock" id="leftAligned">
            <!-- View Selection Buttons -->
            <div class="facultyClassesBlockHead">
                <button type="button" class="facultyConsoleButton" id="inactiveFacultyConsoleButton" disabled>My Classes</button>
                <button type="button" class="facultyConsoleButton" onclick="location.href='facultyConsoleStudents.php'">My Students</button>
            </div>

            <!-- Search Bar -->
            <input type="text" class="searchBar" placeholder="Search">

            <?php
                // Fetch Faculty's Classes
                $classesQuery = "SELECT *
                                 FROM classes AS c
                                 WHERE $user_data[facultyID] = c.facultyID
                                 ORDER BY CAST(SUBSTRING_INDEX(semester, ' ', -1) AS UNSIGNED) DESC;";

                $classesResult = mysqli_query($conn, $classesQuery);

                // Verify Query & Results Exist
                if ($classesResult && mysqli_num_rows($classesResult) > 0) {
                    // Scrollbar Style Fix
                    if (mysqli_num_rows($classesResult) > 3)
                        echo("<div class='classesBlockBody' style='border-radius: 15px 0 0 15px'>");
                    else
                        echo("<div class='classesBlockBody'>");

                    // For Each Class
                    while ($assignedClass = mysqli_fetch_assoc($classesResult)) {
                        // Fetch Class' Student Count
                        $studentCountQuery = "SELECT COUNT(*) AS count
                                            FROM stuToClassMap AS scMap
                                            WHERE scMap.classID = $assignedClass[classID]";

                        $studentCountResult = mysqli_query($conn, $studentCountQuery);

                        // Verify Query
                        if (!($studentCountResult))
                            die("ERROR: Could not acquire student count for class " + $assignedClass[name]);
                        else {
                            $studentCount = mysqli_fetch_assoc($studentCountResult);

                            // Append Class To List
                            echo("
                                <a href='facultyClass.php?cID=$assignedClass[classID]' class='classLink'>
                                    <div class='classBlockItem'>
                                        <h4 class='classBlockItemInfo'><strong>$assignedClass[name]</strong> ~ <strong>$user_data[username]</strong> ($assignedClass[semester], $assignedClass[section])</h4>
                                        <h4 class='classBlockItemInfo'>Students: $studentCount[count]</h4>
                                    </div>
                                </a>
                                <hr>
                            ");
                        }
                    }

                    echo("</div>");
                }
                else {
                    // Display No Classes Massage
                    echo("
                        <div class='classesBlockBody'>
                            <p style='position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%)' class='classBlockItemInfo'>You have not created any classes.</p>
                        </div>
                    ");
                }
            ?>
        </div>

        <!-- Add Class Form -->
        <div class="addClassFormDiv">
            <p class="loginHeader">Add Class</p>

            <form class="loginForm" method="post">
                <input type="text" name="className" class="loginFormElement" placeholder="Enter Class Name">
                <input type="text" name="classSection" class="loginFormElement" placeholder="Enter Class Section">
                <input type="text" name="classSemester" class="loginFormElement" placeholder="Enter Class Semester">
                <input type="submit" value="Create Class" class="loginFormButton">
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