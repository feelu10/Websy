<?php
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['username']);
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
  echo '<audio id="background_music" src="assets/music/bgMusic.mp3" type="audio/mpeg" autoplay loop></audio>';

  echo '
  <script>
      window.onload = function() {
          var audioElement = document.getElementById("background_music");
  
          // Check if there\'s a saved playback time
          var savedTime = localStorage.getItem("playbackTime");
          if (savedTime) {
              audioElement.currentTime = savedTime;
          }
  
          audioElement.play();
  
          // Save the playback time every second
          setInterval(function() {
              localStorage.setItem("playbackTime", audioElement.currentTime);
          }, 1000);
      };
  </script>
  ';
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-Wa+3Bg3Tx7aTQw4r5D4jEHkIz4lOmvVsUX5yULVGq3XK4J1hTF4W06h6dxuXl65iS6SzVT+lhUqf5nku4TTkQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<head>
<style>
  .footer{
  margin-top: 7rem;
}
</style>
<title>Chinese Zodiac Sign</title>
  <link rel="stylesheet" type="text/css" href="css_website-design/ChineseZodiac.css" />
  <link rel="stylesheet" href="assets/css/index.css">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Add the favicon link below -->
  <link rel="icon" type="image/x-icon" href="favicon.ico" />
</head>

<body style="background-color: black;">
  <?php
  if (isset($_SESSION['message'])) {
      echo "<div class='message'>{$_SESSION['message']}</div>";
      // Unset the message after displaying it
      unset($_SESSION['message']);
  }
  ?>
<nav>
  <div class="nav_text" align="center">
    <?php include("inc/inc_header.php"); ?>
  </div>

  <?php
  // Check if the user is logged in
  if (isset($_SESSION['username'])) {
  ?>
    <br>
    <div class="nav_text" align="center">
      <?php include("link/inc_text_links.php"); ?>
    </div>
    <br>
  
  <div class="btn" align="center">
    <?php include("inc/inc_button_nav.php"); ?>
  </div>
  <?php
  } // This ends the if statement checking if the user is logged in.
  ?>
  
</nav>
<?php
// Define the list of excluded pages
$excludedPages = [
  'site_layout',
  'control_structures',
  'string_functions',
  'web_forms',
  'midterm_assessment',
  'state_information',
  'user_templates',
  'final_project'
];

// Get the current page from the URL query parameter
$currentPage = isset($_GET['page']) ? $_GET['page'] : '';

// Check if the current page is one of the excluded pages
$hideZCS = in_array($currentPage, $excludedPages);
?>


<table width="100%" align="center">
<td width="50%" align="center">
<?php if (!$loggedIn): ?>
      <a href="login.php" style="color:white; text-decoration:none;">
        <i class="fas fa-user">
        <p>Click here to see more features</p>
        </i> 
      </a>
    <?php endif; ?>
      <div class="layout-group">
        <div class="dynamic_content">
          <?php
          // Handle dynamic content based on the current page
          if (isset($_GET['page'])) {
            switch ($_GET['page']) {
              case 'home_page':
                include('inc/inc_home.php');
                break;
              case 'site_layout':
                include('inc/inc_site_layout.php');
                break;
              case 'control_structures':
                include('inc/inc_control_structure.php');
                break;
              case 'string_functions':
                include('inc/inc_string_function.php');
                break;
              case 'web_forms':
                include('inc/inc_web_form.php');
                break;
              case 'midterm_assessment':
                include('MidtermAssessment/inc_midterm_assessment.php');
                break;
              case 'state_information':
                include('inc/inc_state_info.php');
                break;
              case 'user_templates':
                include('inc/inc_post.php');
                break;
              case 'final_project':
                include('inc/inc_final.php');
                break;
              case 'account':
                include('inc/inc_account.php');
                break;
              
            }
          }
          ?>
        </div>
      </div>
    </td>
  <tr>
    <?php if (!$hideZCS): ?>
      <td width="50%" align="center">
        <div class="zsc">
          <?php include('inc/inc_zcs.php'); ?>
        </div>
      </td>
    <?php endif; ?>

    <!-- End ZSC -->
  </tr>
</table>

  <br>

  <div class="footer" align="center">
    <?php include("inc/inc_footer.php");?>
  </div>
  <script src="assets/js/popupMsg.js"></script>
</body>
</html>
