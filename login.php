<!DOCTYPE html>

<!-- Andy Estevez -->
<!-- BMCC Tech Innovation Hub Internship -->
<!-- Spring Semester 2024 -->
<!-- BMCC INC Grade Project -->
<!-- Log In Page -->

<?php
    session_start();

    include("config.php");
    include("functions.php");

    // When Log In Form Is Submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $accountType = $_POST["accountType"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Verify Whether Email/Password Are Filled Out
        if (!empty($email) && !empty($password)) {
            if ($accountType == "student") {
                $query = "select * from students where email = '$email' limit 1";
            }
            else if ($accountType == "faculty") {
                $query = "select * from faculty where email = '$email' limit 1";
            }
            else {
                die("ERROR: Invalid account type during account log in.");
            }

            // THIS COULD USE SOME POTENTIAL IMPROVEMENTS ^

            $result = mysqli_query($conn, $query);

            // If Account Is Found
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                    
                // If Password Matches
                if ($user_data["password"] === $password) {
                    // Init Session Data & Redirect User To Appropriate Console
                    if ($accountType == "student") {
                        $_SESSION["studentID"] = $user_data["studentID"];
                        header("Location: studentConsole.php");
                        die;
                    }
                    else if ($accountType == "faculty") {
                        $_SESSION["facultyID"] = $user_data["facultyID"];
                        header("Location: facultyConsoleClasses.php");
                        die;
                    }
                    else {
                        die("ERROR: Invalid account type during account log in.");
                    }
                }
            }

            /* Handle Incorrect Input Here */
        }
        else {
            /* Handle Invalid Input Here */
        }
    }
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>BMCC Grades Log In Page</title>
    </head>

    <body class="loginBody">
        <!-- Header / Navigation Bar -->
        <nav>
            <a href="https://www.bmcc.cuny.edu" target="_blank" onclick="return confirm('This will take you to the main BMCC page')">
                <img class="BMCCLogo" src="Elements\bmcc-logo-two-line-wide-WHITE.png" alt="BMCC Logo" height="50px">
            </a>
            <div class="NavButtonsContainer" id="console">
                <button type="button" class="navButton" onclick="location.href='index.html'">Home</button>
            </div>
        </nav>

        <!-- Log In Section -->
        <div class="loginDiv">
            <p class="loginHeader">Log In</p>

            <!-- Log In Form -->
            <form class="loginForm" method="post">
                <input type="email" name="email" class="loginFormElement" placeholder="Enter Email" autocomplete="email">
                <input type="password" name="password" class="loginFormElement" placeholder="Enter Password">

                <div>
                    <label>
                        <input type="radio" name="accountType" value="student" checked>Student
                    </label>
                    <label>
                        <input type="radio" name="accountType" value="faculty">Faculty
                    </label>
                </div>

                <input type="submit" value="Log In" class="loginFormButton">

                <a class="registerLink" href="signup.php">Don't have an account? Register here.</a>
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