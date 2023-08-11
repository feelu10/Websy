<?php
/* Start the session and retrieve the ProfileID from a cookie on the session
ProfileID is not set. */

session_start();
if (!isset($_SESSION['ProfileID'])) {
    if (!isset($_COOKIE['ProfileID'])) {
        $_SESSION['ProfileID']=
                $_COOKIE['ProfileID'];
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C.w3.org/TR/xtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xtml">
    <head>
        <title>Chinese Zodiac Social Network - My Profile</title>
    </head>
    <body>
        <h1>Chinese Zodiac Social Network</h1>
        <?php
        require_once("inc/inc_chinesezodiacDB.php");
        if (isset($_SESSION['ProfileID'])) {
            echo "<h2>Member Pages</h2>\n";
            echo "<p>Below is a list of the members of " . 
                    "the Chinese Zodiac Social " . 
                    "Network. Click on a member's " . 
                    "name tp view a that a member's " . 
                    "detailed information. You may " . 
                    "also choose to " . 
                    " <a href='czsn_myprofile.php'>" . 
                    "update your profile</a>.</p>\n";
                    //TODO: Show member list here.
        }
        else {
            echo "<h2>Not Signed In</h2>\n";
            echo "<p>You are not curretly logged into " . 
                    "the Chinese Zodiac Social " . 
                    "Network, If you are a " . 
                    "member, please " . 
                    "<a href='czsn_login.php'>" . 
                    "log in.</a> to view this page. </p>" . 
                    "<p>If you are not a member but " . 
                    "would like to join , please " . 
                    "< a href='czsn_myprofile.php'>" . 
                    "create a profile</a> to become " . 
                    "a member.</p>\n";
        }
        ?>
    </body>
</html>