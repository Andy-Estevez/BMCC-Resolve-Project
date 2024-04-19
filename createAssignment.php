<!DOCTYPE html>

<!-- Andy Estevez / Smedly Moise -->
<!-- BMCC Tech Innovation Hub Internship -->
<!-- Spring Semester 2024 -->
<!-- BMCC Resolve Project -->
<!-- Faculty Assignment Creator Page -->

<?php
    // PHP / Data Set Up
    session_start();

    include("config.php");
    include("functions.php");

    $user_data = check_faculty_login($conn);
    $classID = $_GET["cID"];

    // When Add Assignment Form Is Submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $assignmentTitle = $_POST["assignmentTitle"];
        $assignmentDescription = $_POST["assignmentDescription"];
        $assignmentDueDate = $_POST["assignmentDueDate"];

        // Verify Inputs Not Empty
        if (!empty($assignmentTitle) && !empty($assignmentDescription) && !empty($assignmentDueDate)) {
            // Create New Class Entry
            $query = "INSERT INTO assignments (assignments.facultyID, assignments.classID, assignments.title, assignments.description, assignments.dueDate)
                      VALUES ('$user_data[facultyID]', '$classID', '$assignmentTitle', '$assignmentDescription', '$assignmentDueDate');";

            // Verify Query Successful
            if (mysqli_query($conn, $query)) {
                // Fetch Class' Student Count
                $studentsQuery = "SELECT *
                                 FROM stuToClassMap AS scMap
                                 WHERE scMap.classID = $classID";

                $studentsResult = mysqli_query($conn, $studentsQuery);

                // Verify Query
                if (!$studentResult)
                    die("ERROR: Could not acquire student count for class with ID " + $classID);

                // For Each Student
                while ($assignedStudent = mysqli_fetch_assoc($studentsResult)) {
                    // Add to staMap
                }
            } 
            else {
                die("ERROR: Class creation failed.");
            }
        }
    }
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>BMCC Resolve | Class Viewer</title>
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
                <button type="button" class="navButton" onclick="location.href='facultyClass.php?cID=<?php echo($classID)?>'">Return</button>
            </div>
        </nav>

        <!------------->
        <!-- Content -->
        <!------------->

        <?php
             // Fetch Class Info
            $classQuery = "SELECT * 
                           FROM classes AS c
                           WHERE $classID = c.classID";

            $classResult = mysqli_query($conn, $classQuery);

            // Verify Query
            if (!$classResult)
                die("ERROR: Could not acquire class & faculty data for info banner of class with ID " + $classID);

            $classInfo = mysqli_fetch_assoc($classResult);

            // Fetch Class' Student Count
            $studentCountQuery = "SELECT COUNT(*) AS count
                                  FROM stuToClassMap AS scMap
                                  WHERE scMap.classID = $classID";

            $studentCountResult = mysqli_query($conn, $studentCountQuery);

            // Verify Query
            if (!$studentCountResult)
                die("ERROR: Could not acquire student count for class " + $classInfo[name]);

            $studentCount = mysqli_fetch_assoc($studentCountResult);

            // Display Class Info Banner
            echo("
                <div class='classInfo student'>
                    <p class='classesBlockHeader'>
                        <strong>Class</strong>: $classInfo[name] // 
                        <strong>Section</strong>: $classInfo[section] // 
                        <strong>Semester</strong>: $classInfo[semester] // 
                        <strong>Year</strong>: $classInfo[year] // 
                        <strong>Students</strong>: $studentCount[count]
                    </p>
                </div>
            ");
        ?>

        <!-- Add Assignment Form -->
        <div class="addClassFormDiv assignmentAdder">
            <p class="loginHeader">Add Assignment</p>

            <form class="loginForm" method="post">
                <div class="classDateHolder assignmentAdder">
                    <input type="text" name="assignmentTitle" class="loginFormElement title" placeholder="Enter Assignment Title">
                    <input type="datetime-local" name="assignmentDueDate" class="loginFormElement" placeholder="Enter Assignment Deadline">
                </div>

                <!-- Assignment Description -->
                <input type="text" name="assignmentDescription" class="loginFormElement desc" placeholder="Enter Assignment Description">

                <input type="submit" value="Create Assignment" class="loginFormButton assignmentAdder">
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