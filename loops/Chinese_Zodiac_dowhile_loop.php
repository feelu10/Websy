<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://w.w3.org/1999/xhtml">
<head>
<title>Chinese Zodiac - Do-While Loop</title>
<link rel="stylesheet" type="text/css" href="ChineseZodiac.css" />
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
    <h1>Chinese Zodiac - Do-While Loop</h1>
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
        foreach ($SignNames as $sign) {
            echo "<th>" . $sign . "<br />\n";
            echo "<img src='assets/zodiacs_imgs/" . $sign . ".png' alt='" .
            $sign . "' title='" .
            $sign . "' width=120px' /></th>\n";
        }
        echo "</tr>\n";

        $rowCount = ceil(($endYear - $startYear + 1) / count($SignNames));
        $row = 1;

        do {
            echo "<tr>\n";
            foreach ($SignNames as $sign) {
                if ($currentYear <= $endYear) {
                    echo "<td>$currentYear</td>\n";
                    $currentYear++;
                } else {
                    echo "<td></td>\n"; // Empty cell for additional space if needed
                }
            }
            echo "</tr>\n";
            $row++;
        } while ($row <= $rowCount);

        echo "</table>\n";
    ?>
</body>
</html>
