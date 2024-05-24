<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BMCC Resolve | Admin | Home</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <nav>
    <a href="facultyHome.php">
      <img class="BMCCLogo" src="Elements/bmcc-logo-resolve.png" alt="BMCC Logo" height="50px">
    </a>

    <div class="NavButtonsContainer">
      <button type="button" class="navButton" onclick="location.href='adminHome.php'">Home</button>
      <button type="button" class="navButton" onclick="location.href='adminConsoleClasses.php'">Console</button>
      <button type="button" class="navButton" onclick="location.href='adminProfile.php'">Profile</button>
      <button type="button" class="navButton" id="login" onclick="location.href='logout.php'">Log Out</button>
    </div>
  </nav>

  <div class="container">
  <div class="flex-item-1">
    <h2 id="welcome-title">Administrator Homepage (Under Construction)</h2>
  </div>
    <?php
        // PHP / Data Set Up
        session_start();
        
        include("config.php");
        include("functions.php");
        ?>
  </div>
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


</body>
</html>
