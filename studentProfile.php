<!-- Andy Estevez -->
<!-- BMCC Tech Innovation Hub Internship -->
<!-- Spring Semester 2024 -->
<!-- BMCC INC Grade Project -->
<!-- Student Profile Page -->

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
        <title>BMCC Grades Student Profile</title>
    </head>

    <body>
        <!-- Header / Navigation Bar -->
        <nav>
            <a href="https://www.bmcc.cuny.edu" target="_blank" onclick="return confirm('This will take you to the main BMCC page')">
                <img class="BMCCLogo" src="Elements\bmcc-logo-two-line-wide-WHITE.png" alt="BMCC Logo" height="50px">
            </a>
            <div class="NavButtonsContainer">
                <button type="button" class="navButton" onclick="location.href='studentConsole.php'">Classes</button>
                <button type="button" class="navButton" onclick="location.href='studentProfile.php'">Profile</button>
                <button type="button" class="navButton" id="login" onclick="location.href='logout.php'">Log Out</button>
            </div>
        </nav>

        <!-- Content -->
        <div class="profileDiv">
            <p class="profileHeader">Profile</p>

            <div class="profileBody">
                <?php 
                    echo("
                        <p class='profileText'><strong>Username</strong>: $user_data[username]</p>
                        <hr>
                        <p class='profileText'><strong>UserID</strong>: $user_data[studentID]</p>
                        <hr>
                        <p class='profileText'><strong>Email</strong>: $user_data[email]</p>
                    ");
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
    </body>
</html>