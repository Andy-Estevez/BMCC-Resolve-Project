<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>BMCC Resolve | Student | Home</title>
</head>
<body>
     <!-- Header / Navigation Bar -->
     <nav>
        <a href="studentHome.php">
            <img class="BMCCLogo" src="Elements\bmcc-logo-resolve.png" alt="BMCC Logo" height="50px">
        </a>
        <div class="NavButtonsContainer">
            <button type="button" class="navButton" onclick="location.href='studentHome.php'">Home</button>
            <button type="button" class="navButton" onclick="location.href='studentConsole.php'">Console</button>
            <button type="button" class="navButton" onclick="location.href='studentProfile.php'">Profile</button>
            <button type="button" class="navButton" id="login" onclick="location.href='logout.php'">Log Out</button>
        </div>
    </nav>
   

    <!--<div class="progress_box">-->
        <!--<h2>Progress</h2>-->
        <!--<div class="classes_container">-->
        <!--  <span class="classes">PHYS 215</span>-->
         <!-- <span class="classes">CSC 301</span>-->
         <!-- <span class="classes">ENG 111</span>-->
          <!--<span class="classes">GYM 101</span>-->
         <!-- <span class="classes">ART 108</span>-->
        <!--</div>-->
     <!-- </div>-->
      

  <div class="container">
  <div class="flex-item-1">
    <h2 id="welcome-title">Student Homepage</h2>
    <p>
        The "INC" (Incomplete) grade is assigned when a Semester/Term's work is incomplete. The instructor has reasonable 
        expectations that the student can receive a passing grade after completing the missing assignment(s), and agrees to 
        work with the student to make up the missing work. The Student must agree with the faculty to make up the missing work 
        before the "INC" deadline, which is published on the BMCC
        <a href="https://www.bmcc.cuny.edu/academics/academic-calendar/spring-regular-2024/#:~:text=%22NC%22%20grade-,May%2015,lapse%20of%20INC%20to%20FIN%20from%20Fall%202023%20and%20Winter%202024,-May%2015" target="_blank">Academic Calendar</a>.
    </p>

    <p>
        The “INC” grade converts into a 
        <a href="fin_grade.html" target="_blank">“FIN” grade</a> 
        if all responsibilities assigned to the student by the
        instructor are not met by the "INC" deadline. "FIN" grades are treated as "F" (Failure) grades and will have negative
        consequences on GPA. They may also impact financial aid status, and cause you to not meet graduation requirements.
        Be mindful of the fact that the "INC" deadline may vary depending on the semester. Typically, If an "INC" grade is 
        assigned to a student for a class that took place in the Fall semester, the "INC" deadline for that student will fall 
        sometime in the Spring semester, and vice versa. Refer to the Academic Calendar to learn when this deadline may be for
        you.
    </p>

    <p>
        Remember to reach out to your professor to confirm what work must be completed and by when, in order to earn a standard 
        letter grade. Make sure to have this information stored somewhere that is readily available should you ever need it again.
        All missing coursework must be completed no later than the deadline posted on the Academic Calendar. If your work is not 
        submitted by that deadline, your "INC" grade will become a "FIN" grade, and faculty may not be able to change it into another 
        letter grade after the deadline.
    </p>
  </div>

  <div class="flex-item-2">
    <h2 id="assignments-title">Pressing Assignments</h2>
       <hr>
    <?php
        // PHP / Data Set Up
        session_start();
        
        include("config.php");
        include("functions.php");

        $user_data = check_student_login($conn);
                   
        // SQL query to select top 10 assignments due soonest
        $sql = "SELECT *
                FROM stutoassignmentmap AS staMap
                LEFT JOIN assignments AS a
                ON staMap.assignmentID = a.assignmentID
                LEFT JOIN classes AS c
                ON staMap.classID = c.classID
                WHERE staMap.studentID = $user_data[studentID]
                ORDER BY a.dueDate ASC LIMIT 10";

        $result = $conn->query($sql);
        
        // Fetch data and display in the format you want
        if ($result && $result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                // Output assignment title
                echo("<a href='studentClass.php?cID=$row[classID]' class='classLink'>");
                echo '<div class="assignment" style="padding: 10px; margin: 10px 0; border-radius: 20px; background-color: #002874;">';
                echo '<h3 class="assignment-title">' . $row["title"] . '</h3>';
                
                // Output assignment due date
                echo '<p class="due-date">Due: ' . $row["dueDate"] . '</p>';

                // Output assignment class
                echo("<p class='due-date'>Class: ".$row["name"]."</p>");
                
                // Output the countdown span
                //echo '<div class="countdown" id="countdown-' . $row["title"] . '"></div>';
                
                // JavaScript for countdown
                /*echo '<script>';
                echo 'function updateCountdown_' . $row["title"] . '() {';
                echo '    const now = new Date();';
                echo '    const dueDate = new Date("' . $row["dueDate"] . '");';
                echo '    const diffInMs = dueDate - now;';
                echo '';
                echo '    if (diffInMs <= 0) {';
                echo '        document.getElementById("countdown-' . $row["title"] . '").textContent = "Due";';
                echo '    } else {';
                echo '        const days = Math.floor(diffInMs / (1000 * 60 * 60 * 24));';
                echo '        const hours = Math.floor((diffInMs % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));';
                echo '        const minutes = Math.floor((diffInMs % (1000 * 60 * 60)) / (1000 * 60));';
                echo '        const seconds = Math.floor((diffInMs % (1000 * 60)) / 1000);';
                echo '';
                echo '        const formattedTime = days + "d " + hours + "h " + minutes + "m " + seconds + "s";';
                echo '        document.getElementById("countdown-' . $row["title"] . '").textContent = formattedTime;';
                echo '    }';
                echo '}';
                echo '';
                echo 'setInterval(updateCountdown_' . $row["title"] . ', 1000);';
                echo 'updateCountdown_' . $row["title"] . '(); // Initial call to update immediately';
                echo '</script>';*/
                
                echo '</div>';
                echo("</a>");
            }
        } else {
            echo "0 results";
        }
        ?>
  </div>
</div>
    
  
 <!-- IBM Watson Chatbot -->
 <script>
            window.watsonAssistantChatOptions = {
              integrationID: "1db7fbd1-e4f7-4a21-8299-7b79b90d0406", // The ID of this integration.
              region: "us-east", // The region your integration is hosted in.
              serviceInstanceID: "ae83b918-3f7e-463e-a2ac-8327cd35ef06", // The ID of your service instance.
              onLoad: async (instance) => { await instance.render(); }
            };
            setTimeout(function(){
              const t=document.createElement('script');
              t.src="https://web-chat.global.assistant.watson.appdomain.cloud/versions/" + (window.watsonAssistantChatOptions.clientVersion || 'latest') + "/WatsonAssistantChatEntry.js";
              document.head.appendChild(t);
            });
 </script>

    
  
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