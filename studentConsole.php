<!-- Andy Estevez -->
<!-- BMCC Tech Innovation Hub Internship -->
<!-- Spring Semester 2024 -->
<!-- BMCC INC Grade Project -->
<!-- Student Console Page -->

<?php
    session_start();

    include("config.php");
    include("functions.php");

    $user_data = check_student_login($conn);
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>BMCC Grades Student Console</title>
    </head>

    <body>
        <!-- Header / Navigation Bar -->
        <nav>
            <a href="https://www.bmcc.cuny.edu" target="_blank" onclick="return confirm('This will take you to the main BMCC page')">
                <img class="BMCCLogo" src="Elements\bmcc-logo-two-line-wide-WHITE.png" alt="BMCC Logo" height="50px">
            </a>
            <div class="NavButtonsContainer">
                <button type="button" class="navButton" onclick="location.href='studentConsole.php'">Classes</button>
                <button type="button" class="navButton" onclick="location.href='profile.php'">Profile</button>
                <button type="button" class="navButton" id="login" onclick="location.href='logout.php'">Log Out</button>
            </div>
        </nav>

        <!-- Content -->
        <div class="classesBlock">
            <div class="classesBlockHead">
                <h2 class="classesBlockHeader">My Classes</h2>
            </div>
            
            <div class="classesBlockBody">
                <?php
                    $classesQuery = "SELECT * 
                                    FROM stutoclassmap AS scMap
                                    LEFT JOIN classes AS c
                                    ON scMap.classID = c.classID 
                                    LEFT JOIN faculty AS f
                                    ON c.facultyID = f.facultyID 
                                    WHERE $user_data[studentID] = scMap.studentID 
                                    ORDER BY semester DESC;";

                    $classesResult = mysqli_query($conn, $classesQuery);

                    if ($classesResult && mysqli_num_rows($classesResult) > 0) {
                        while ($assignedClass = mysqli_fetch_assoc($classesResult)) {
                            echo("
                                <a href='studentClass.php?cID=$assignedClass[classID]' class='classLink'>
                                    <div class='classBlockItem'>
                                        <h4 class='classBlockItemInfo'><strong>$assignedClass[name]</strong> ~ <strong>$assignedClass[username]</strong> ($assignedClass[semester], $assignedClass[section])</h4>
                                        <h4 class='classBlockItemInfo'>Grade: $assignedClass[grade]</h4>
                                    </div>
                                </a>
                                <hr>
                            ");
                        }
                    }
                    else {
                        echo("<p style='position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%)' class='classBlockItemInfo'>You are not assigned to any classes.</p>");
                    }
                ?>
            </div>
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

        <!-- Content -->
        <?php
            // $assignedClassQuery = "SELECT * FROM stutoclassmap WHERE $user_data[studentID] = studentID";
            // $assignedClassResult = mysqli_query($conn, $assignedClassQuery);
            
            // // Fetch Classes
            // if ($assignedClassResult && mysqli_num_rows($assignedClassResult) > 0) {
            //     while ($assignedClassEntry = mysqli_fetch_assoc($assignedClassResult)) {
            //         //echo("<h1>Class ID: $assignedClassEntry[classID]; Grade: $assignedClassEntry[grade]</h1>");

            //         echo("
            //             <div class='classBlock'>
            //                 <div class='classInfoHolder'>
            //         ");

            //         $classInfoQuery = "SELECT * FROM classes WHERE $assignedClassEntry[classID] = classID";
            //         $classInfoResult = mysqli_query($conn, $classInfoQuery);

            //         // Fetch Specific Class Info
            //         if ($classInfoResult && mysqli_num_rows($classInfoResult) > 0) {
            //             $classInfoEntry = mysqli_fetch_assoc($classInfoResult);
            //             //echo("<h1>Class Name: $classInfoEntry[name]</h1>");
            //             //echo("<h2>Faculty's ID: $classInfoEntry[facultyID]</h2>");

            //             echo("
            //                 <h2 class='classInfoHeader'>$classInfoEntry[name]</h2>
            //                 </div>
            //             ");

            //             $facultyInfoQuery = "SELECT * FROM faculty WHERE $classInfoEntry[facultyID] = facultyID";
            //             $facultyInfoResult = mysqli_query($conn, $facultyInfoQuery);

            //             // Fetch Faculty Info
            //             if ($facultyInfoResult && mysqli_num_rows($facultyInfoResult) > 0) {
            //                 $facultyInfoEntry = mysqli_fetch_assoc($facultyInfoResult);
            //                 echo("<h3 class='classInfoSubHeader'>Faculty's Name: $facultyInfoEntry[username]</h3>");
            //                 echo("<h3 class='classInfoSubHeader'>Faculty's Email: $facultyInfoEntry[email]</h3>");
            //                 echo("<h3 class='classInfoSubHeader'>Assignments:</h3>");

            //                 $assignmentQuery = "SELECT * FROM stutoassignmentmap WHERE $user_data[studentID] = studentID AND $assignedClassEntry[classID] = classID";
            //                 $assignmentResult = mysqli_query($conn, $assignmentQuery);

            //                 // Fetch Assignments
            //                 if ($assignmentResult && mysqli_num_rows($assignmentResult) > 0) {
            //                     while ($assignmentEntry = mysqli_fetch_assoc($assignmentResult)) {
            //                         echo("<h3 class='classInfoSubHeader'>Assignment ID: $assignmentEntry[assignmentID]; Completion Status: $assignmentEntry[completionStatus]</h3>");

            //                         $assignmentInfoQuery = "SELECT * FROM assignments WHERE $assignmentEntry[assignmentID] = assignmentID";
            //                         $assignmentInfoResult = mysqli_query($conn, $assignmentInfoQuery);

            //                         // Fetch Specific Assignment Info
            //                         if ($assignmentInfoResult && mysqli_num_rows($assignmentInfoResult) > 0) {
            //                             $assignmentInfoEntry = mysqli_fetch_assoc($assignmentInfoResult);
            //                             echo("<h3 class='classInfoSubHeader'>Assignment Title: $assignmentInfoEntry[title]</h3>");
            //                             echo("<h3 class='classInfoSubHeader'>Assignment Description: $assignmentInfoEntry[description]</h3>");
            //                             echo("<h3 class='classInfoSubHeader'>Assignment Due Date: $assignmentInfoEntry[dueDate]</h3>");
            //                             echo "<a style='color: lightgray;' href='confirm_turn_in.php?assignmentID=" . $assignmentEntry['assignmentID'] . "'>Toggle Completion</a>";
            //                             //echo("<br><br>~");
            //                         }
            //                     }
            //                 }
            //             }
            //         }

            //         echo("</div>");
            //     }
            // }
            // else {
            //     echo("<h3 style='text-align: center; padding-top: 25px;'>You are not assigned to any classes.</h3>");
            // }
        ?>
    </body>
</html>