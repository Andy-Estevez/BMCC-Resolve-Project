<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BMCC Resolve | Faculty Console</title>
  <link rel="stylesheet" href="styles.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/countdowntimer/2.1.0/countdowntimer.min.js"></script>
</head>
<body>
  <nav>
    <a href="facultyHome.php">
      <img class="BMCCLogo" src="Elements/bmcc-logo-resolve.png" alt="BMCC Logo" height="50px">
    </a>

    <div class="NavButtonsContainer">
      <button type="button" class="navButton" onclick="location.href='facultyHome.php'">Home</button>
      <button type="button" class="navButton" onclick="location.href='facultyConsoleClasses.php'">Console</button>
      <button type="button" class="navButton" onclick="location.href='facultyProfile.php'">Profile</button>
      <button type="button" class="navButton" id="login" onclick="location.href='logout.php'">Log Out</button>
    </div>
  </nav>

  <h1>Welcome</h1>
  <div class="calendar-container" id="leftAligned">
  <h2>Calendar</h2>
  <div class="calendar-content">
    <a href="https://www.bmcc.cuny.edu/academics/academic-calendar/spring-regular-2024/">
      <img src="Elements/calendar-icon-.avif" alt="BMCC Academic Calendar" height="100px">
    </a>
    <p>See BMCC Calendar</p>
  </div>
  <script src="countdown.js"></script>
  <div id="countdown-container"></div>

  <form class="countdown-form">
    <label for="deadline">Enter Deadline (YYYY-MM-DD HH:MM):</label>
    <input type="datetime-local" id="deadline" name="deadline" required>
    <button type="submit">Set Countdown</button>
  </form>
</div>


  <div class="addClassFormDiv">
    <p class="loginHeader">Send Notification</p>

    <form class="loginForm" method="post">
      <input type="text" name="Title" class="loginFormElement" placeholder="Enter Title"><br>
      <input type="text" name="Message" class="loginFormElement" placeholder="Message" ><br>
      <input type="submit" value="Send" class="loginFormButton">
    </form>
  </div>
  
  <footer>
    <a class="footerLink" href="https://maps.app.goo.gl/87HcM8tEhsrWe9wH6" target="_blank">
      <p class="footerText">
        <u>Borough of Manhattan Community College <br>
          The City University of New York <br>
          199 Chambers Street <br>
          New York, NY 10007
        </u>
      </p>
    </a>
  </footer>
</body>
</html>
