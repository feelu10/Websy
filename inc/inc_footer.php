<p style="color:#ffffff; font-style:italic"><?php

$ProverbFileName = "proverbs.text";

$ProverbArray = file ($ProverbFileName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if ($ProverbArray===FALSE)

echo "There are no proverbs available. \n";

else if (count ($ProverbArray)==0)

echo "There are no proverbs available. \n";

else {

$i = rand (0, count ($ProverbArray) -1);

echo "&ldquo;" . htmlentities (trim($ProverbArray[$i])) . "&rdquo; \n";

}

?>

</p>
 <div class="first-container">
<p style="color: #ffffff;font-style:italic"> &copy; Created and Designed by Wilfredo Joshua De Leon Jr.</p>
    <p style="color: #ffffff"> w3schools.com | Ms Bungay | Chinese Zodiac signs. All rights reserved.</p>
        <p style="color: #ffffff"> &copy; WEBSYS1 Class 2023 </p>
 </div>
 <div class="second-container">
 <div class="time" id="time"><?php echo date('H:i:s'); ?></div>
        <div class="date" id="date"><?php echo 'Today is ' . date('Y-m-d'); ?></div>
    </div>

    <script src="script.js"></script> <!-- Include the external JavaScript file -->
