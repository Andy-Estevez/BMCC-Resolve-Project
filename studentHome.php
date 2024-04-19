<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Student homepage</title>
</head>
<body>
     <!-- Header / Navigation Bar -->
     <nav>
        <a href="https://www.bmcc.cuny.edu" target="_blank" onclick="return confirm('This will take you to the main BMCC page')">
            <img class="BMCCLogo" src="Elements\bmcc-logo-two-line-wide-WHITE.png" alt="BMCC Logo" height="50px">
        </a>
        <div class="NavButtonsContainer">
            <button type="button" class="navButton" onclick="location.href='studentHome.php'">Home</button>
            <button type="button" class="navButton" onclick="location.href='studentConsole.php'">Console</button>
            <button type="button" class="navButton" onclick="location.href='studentProfile.php'">Profile</button>
            <button type="button" class="navButton" id="login" onclick="location.href='login.php'">Log In</button>
        </div>
    </nav>
   

    <div class="progress_box">
        <h2>Progress</h2>
        <div class="classes_container">
          <span class="classes">PHYS 215</span>
          <span class="classes">CSC 301</span>
          <span class="classes">ENG 111</span>
          <span class="classes">GYM 101</span>
          <span class="classes">ART 108</span>
        </div>
      </div>
      
  
      <h2>Inc grade info</h2>
      <p>Term’s work incomplete. Instructor has reasonable expectation that the student can receive a passing grade after completing the missing assignment(s) and agrees to work with the student to make up the missing work. Student must also agree with the faculty to make the missing work before the INC deadline which is published on BMCC Academic Calendar on the web. The “INC” grade reverts to an “FIN” if a change is not made by deadline.</p>
    </div>
  
    
      <h2>Study Tips</h2>
      <ul>
        <li>Create a Schedule: <br> Establish a study schedule that includes dedicated time slots for each subject.</li>
        <li>Set Goals: <br> Clearly define your study goals, break them down into smaller achievement tasks</li>
        <li>Use Active learning techniques: <br> Engage with the material actively by summarizing, questioning, or teaching the concepts to someone else</li>
        <li>Take Breaks: <br> Dont forget to take short breaks during long study sessions</li>
        <li>Stay Organized: <br> Keep your study space organized and free from distractions Use tools like planners, calendars, or digital apps to keep track of deadlines</li>
        <li>Seek Clarification: <br> Dont hesitate to ask questions or seek clarifications from teachers, classmates, or online resources when you encounter difficulties</li>
      </ul>
    
  
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