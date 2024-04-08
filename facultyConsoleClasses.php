<!DOCTYPE html>

<!-- Andy Estevez -->
<!-- BMCC Tech Innovation Hub Internship -->
<!-- Spring Semester 2024 -->
<!-- BMCC INC Grade Project -->
<!-- Faculty Console (Classes) Page -->

<?php
    session_start();
    
    include("config.php");
    include("functions.php");
    
    $user_data = check_faculty_login($conn);
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>BMCC Grades Faculty Console</title>
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

        <!-- Content -->
        <div class="classesBlock">
            <div class="facultyClassesBlockHead">
                <button type="button" class="facultyConsoleButton" id="inactiveFacultyConsoleButton" disabled>My Classes</button>
                <button type="button" class="facultyConsoleButton" onclick="location.href='facultyConsoleStudents.php'">My Students</button>
            </div>

            <?php
                $classesQuery = "SELECT *
                                 FROM classes AS c
                                 WHERE $user_data[facultyID] = c.facultyID
                                 ORDER BY semester DESC;";

                $classesResult = mysqli_query($conn, $classesQuery);

                if ($classesResult && mysqli_num_rows($classesResult) > 0) {
                    if (mysqli_num_rows($classesResult) > 3)
                        echo("<div class='classesBlockBody' style='border-radius: 15px 0 0 15px'>");
                    else
                        echo("<div class='classesBlockBody'>");

                    while ($assignedClass = mysqli_fetch_assoc($classesResult)) {
                        $studentCountQuery = "SELECT COUNT(*) AS count
                                            FROM stuToClassMap AS scMap
                                            WHERE scMap.classID = $assignedClass[classID]";

                        $studentCountResult = mysqli_query($conn, $studentCountQuery);

                        if (!($studentCountResult))
                            die("Error: Could not acquire student count for class " + $assignedClass[name]);
                        else
                            $studentCount = mysqli_fetch_assoc($studentCountResult);

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

                    echo("</div>");
                }
                else {
                    echo("
                        <div class='classesBlockBody'>
                            <p style='position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%)' class='classBlockItemInfo'>You have not created any classes.</p>
                        </div>
                    ");
                }
            ?>
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