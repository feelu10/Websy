<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://w.w3.org/1999/xhtml">
<head>
<title>Chinese Zodiac - Nested Loops</title>
<link rel="stylesheet" type="text/css" href="ChineseZodiac.css" />
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
    <h1>Chinese Zodiac - Nested Loops</h1>
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

        $startYear = 1912;
        $endYear = 3000;
        $currentYear = $startYear;

        echo "<table>\n";
        echo "<tr>\n";
        for ($col = 0; $col < 12; $col++) {
            echo "<th>" . $SignNames[$col] . "<br />\n";
            echo "<img src='assets/zodiacs_imgs/" . $SignNames[$col] . ".png' alt='" .
            $SignNames[$col] . "' title='" .
            $SignNames[$col] . "' width=120px' /></th>\n";
        }
        echo "</tr>\n";

        $rows = ceil(($endYear - $startYear + 1) / 12);

        for ($row = 0; $row < $rows; $row++) {
            echo "<tr>\n";
            for ($col = 0; $col < 12; $col++) {
                if ($currentYear <= $endYear) {
                    echo "<td>$currentYear</td>\n";
                    $currentYear++;
                } else {
                    echo "<td></td>\n"; // Empty cell for additional space if needed
                }
            }
            echo "</tr>\n";
        }

        echo "</table>\n";
    ?>
</body>
</html>
