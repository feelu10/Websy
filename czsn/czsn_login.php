<?php
session_start();
/* This is the login page, so we clear any existing session information using session_unset(). */
session_unset();

/* This is the login page, so instead of retrieving the ProfileID from a cookie, we clear any existing ProfileID using setcookie() with a time in the past and an empty value. */
if (isset($_COOKIE['ProfileID'])) {
  setcookie("ProfileID", "", time() - (24 * 60 * 60), "/ChineseZodiac/");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Chinese Zodiac Social Network Member Login</title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
  <h1>Chinese Zodiac Social Network</h1>
  <h2>Member Login</h2>
  <?php
  require_once("inc/inc_chinesezodiacDB.php");
  $BadIndicator = "<span style='color: red; font-weight: bold;'>&nbsp;&#215;</span>";
  $SBadUsernameIndicator = "";
  $SBadPasswordIndicator = "";
  $SUsernameValue = '';
  $PasswordValue = '';
  $ShowForm = true;
  $ErrorMsgs = array();
  $SFirstName = "";

  if (isset($_POST['submit'])) {
    if (isset($_POST['username'])) {
      $SUsernameValue = trim(stripslashes($_POST['username']));
      if (strlen($SUsernameValue) == 0) {
        $ErrorMsgs[] = "A username is required.";
        $SBadUsernameIndicator = $BadIndicator;
      } else {
        $ErrorMsgs[] = "Internal Error (1)";
      }
    }
    if (isset($_POST['password'])) {
      $PasswordValue = trim(stripslashes($_POST['password']));
      if (strlen($PasswordValue) == 0) {
        $ErrorMsgs[] = "A password is required.";
        $SBadPasswordIndicator = $BadIndicator;
      } else {
        $ErrorMsgs[] = "Internal Error (2)";
      }
    }

    if (count($ErrorMsgs) == 0) {
      // Get the last 25 characters of the MD5 value of the password to store in the database.
      $SDBPassword = substr(md5($PasswordValue), -25);
      $SQLQuery = "SELECT ProfileID, first_name " .
        "FROM zodiac_profiles " .
        "WHERE username = '$SUsernameValue' " .
        "AND user_password = '$SDBPassword';";
      $result = $DBConnect->query($SQLQuery);
      if ($result === FALSE) {
        $ErrorMsgs[] = "Internal Error (3)";
      } else {
        if ($result->num_rows > 0) {
          /* Successful login, so we set the session variable and the cookie to the ProfileID value from the database and display the success message instead of the form. */
          $row = $result->fetch_array();
          $_SESSION['ProfileID'] = $row[0];
          setcookie("ProfileID", $row[0], time() + (365 * 24 * 60 * 60), "/ChineseZodiac/");
          $ShowForm = FALSE;
          $SFirstName = $row[1];
        }
        $result->close();
      }
    }
  }

  if ($ShowForm) {
    echo "<p>Please enter your username and password below. Remember that both fields are required and both are case-sensitive.</p>\n";
    if (count($ErrorMsgs) > 0) {
      echo "<span style='color: red;'>\n";
      echo "<p>The following errors were found when validating your username and password.</p>\n";
      echo "<ul>\n";
      foreach ($ErrorMsgs as $Msg) {
        echo "<li>$Msg</li>\n";
      }
      echo "</ul>\n";
      echo "</span>";
    }

    echo "<form action='czsn_login.php' method='POST'>\n";
    echo "Username: ";
    echo "<input type='text' name='username' value='$SUsernameValue' />" . $SBadUsernameIndicator . "<br />\n";
    echo "Password: ";
    echo "<input type='password' name='password' value='$PasswordValue' />" . $SBadPasswordIndicator . "<br />\n";
    echo "<input type='submit' name='submit' value='Log In' /><br />\n";
    echo "</form>\n";
  } else {
    echo "<p>Welcome back, $SFirstName!</p>\n";
    echo "<p>Would you like to visit the <a href='czsn_home.php'>member list</a> or <a href='CZSN_MyProfile'>update your profile</a>?</p>\n";
  }
  ?>
</body>
</html>
