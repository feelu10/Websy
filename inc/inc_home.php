<?php
include "link/inc_home_links.php"; 

if (isset($_GET['section'])) {
    switch ($_GET['section']) {
        case 'ChineseZodiac':
            echo "<h1>Chinese Zodiac</h1>";
            include('ChineseZodiac.php');
            break;
        case 'ChineseZodiacSigns':
            echo "<h1>Chinese Zodiac Signs</h1>";
            include('ChineseZodiacSigns.php');
            break;
        case 'php|info':
            echo "<h1>Php Info</h1>";
            include('inc_info.php');
            break;
        default:
            // Handle the default case here or do nothing if no default behavior is required.
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/0KTCRQH7IO0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</body>
</html>