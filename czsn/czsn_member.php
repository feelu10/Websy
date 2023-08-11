<?php
/* Start the session and retrieve the ProfileID
   from a cookie on the client if the session
   ProfileID is not set. */
session_start();
if (!isset($_SESSION['ProfileID'])) {
    if (isset($_COOKIE['ProfileID'])) {
        $_SESSION['ProfileID'] = $_COOKIE['ProfileID'];
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/1999/xhtml">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Chinese Zodiac Social Network - Member Profile</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
    <h1>Chinese Zodiac Social Network</h1>
    <?php
    require_once("inc/inc_chinesezodiacDB.php");
    // Retrieve member's profile information based upon their ID number stored in Session variable or Cookie value
    if (isset($_SESSION['ProfileID'])) {
        if (isset($_GET['username'])) {
            echo "<h2>Member Profile</h2>\n";
            echo "<p>Below is a list of the members of the Chinese Zodiac Social Network. Click on a member's name to view that member's detailed information. You may also choose to <a href='czsn_myprofile.php'>update your profile</a>.</p>\n";
            // TODO: Show member info here.
            $SQLQuery = "SELECT profileid, first_name, last_name, user_email, user_sign, user_profile FROM zodiac_profile WHERE user_name='" . $_GET['username'] . "';";
            $result = $DBConnect->query($SQLQuery);
            if ($result === FALSE) {
                echo "<p>Internal Error (1)</p>\n";
            } else {
                if ($result->num_rows == 0) {
                    echo "<p>There is no member with the user name '" . $_GET['username'] . "'.</p>\n";
                } else {
                    $row = $result->fetch_assoc();
                    echo "<h3>" . $row['first_name'] . " " . $row['last_name'] . "</h3>\n";
                    echo "<p><strong>User Name:</strong> " . $_GET['username'] . "<br>\n";
                    echo "<strong>Email Address:</strong> <a href='mailto:" . $row['user_email'] . "'>" . $row['user_email'] . "</a><br >\n";
                    echo "<strong>Zodiac Sign: </strong>" . $row['user_sign'] . "<br >\n";
                    echo "<strong>Profile: </strong><br />\n" . $row['user_profile'] . "<br >\n";
                    echo "<hr>\n";
            
                    $SQLQuery2 = "SELECT picture_link, profile_title FROM profile_pictures WHERE profile_id=" . $row['profileid'];
                    $result2 = $DBConnect->query($SQLQuery2);
                    if ($result2 === FALSE) {
                        echo "<p>Internal Error (2)</p>\n";
                    } else {
                        while (($row2 = $result2->fetch_assoc()) != NULL) {
                            echo "<p><img src='" . $row2['picture_link'] . "' alt='" . $row2['profile_title'] . "'/><br />\n";
                            echo $row2['profile_title'] . "</p>\n";
                            echo "<hr>\n";
                        }
                    }
                        $result2->close();
                }
            }
        }
    }

    ?>
</body>
</html>
