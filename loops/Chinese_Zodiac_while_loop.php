<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Chinese Zodiac while loop</title>
<link rel="stylesheet" type="text/css" href="ChineseZodiac.css"/>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
    <h1>Chinese Zodiac while loop</h1>
    <?php
        $SignNames = array(
            "Rat",
            "Ox",
            "Tiger",
            "Rabbit",
            "Dragon",
            "Snake",
            "Horse",
            "Goat",
            "Monkey",
            "Rooster",
            "Dog",
            "Pig");
        echo "<table>\n";
        echo "<tr>\n";
        $i = 0;
        while ($i < 12) {
            echo "<th>" . $SignNames[$i] . "<br />\n";
            echo "<img src='assets/zodiacs_imgs/" . $SignNames[$i] . ".png' alt='" .
            $SignNames[$i] . "' title='" .
            $SignNames[$i] . "' width='120px' /></th>\n"; // Change width to 75 pixels
            ++$i;
        }
        
        $i=1912;
        while ($i<=3000) {
            if ((($i-1912)%12)==0) {
                echo "</tr>\n";
            }
            echo "<td>$i</td>";
            ++$i;
        }
        echo "</tr>\n";
        echo "</table>\n";
    ?>
</body>
</html>
