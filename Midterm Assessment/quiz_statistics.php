<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- Extra credit: The statistics page for the quiz. -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Midterm Assessment: Quiz Statistics</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<h1>Midterm Assessment: Quiz Statistics</h1>
<?php
     $NumQuestions=10;
     $StatisticsFile="statistics/quiz_statistics.txt";
     if (file_exists($StatisticsFile)) {
          $StatisticsArray=file($StatisticsFile);
          echo "<p>" . $StatisticsArray[0] . " visitors have taken the quiz.</p>\n";
          echo "<h4>Questions answered correctly:</h4>\n";
          echo "<table border='1' cellpadding='5' cellspacing='0' width='100%'>\n";
          $TableRow1="   <tr><th>Question #</th>";
          $TableRow2="   <tr><th># Correct</th>";
          $TableRow3="   <tr><th>Percentage</th>";
          for ($i=0;$i<$NumQuestions;++$i) {
               $TableRow1 .= "<th>" . ($i+1) . "</th>";
               $TableRow2 .= "<td align='right'>" . $StatisticsArray[$i+1] . "</td>";
               $TableRow3 .= "<td align='right'>" . 
                    round(100*$StatisticsArray[$i+1]/$NumQuestions,1) . "%</td>";
          }
          $TableRow1.="<tr>\n";
          $TableRow2.="<tr>\n";
          $TableRow3.="<tr>\n";
          echo $TableRow1;
          echo $TableRow2;
          echo $TableRow3;
          echo "</table>\n";
          
          echo "<h4>Scores achieved:</h4>\n";
          echo "<table border='1' cellpadding='5' cellspacing='0' width='100%'>\n";
          $TableRow1="   <tr><th>Score as Count</th>";
          $TableRow2="   <tr><th>Score as Percentage</th>";
          $TableRow3="   <tr><th>Number</th>";
          $TableRow4="   <tr><th>Percentage</th>";
          for ($i=0;$i<=$NumQuestions;++$i) {
               $TableRow1 .= "<th>$i of $NumQuestions</th>";
               $TableRow2 .= "<th>" . round(100*$i/$NumQuestions) . "%</th>";
               $TableRow3 .= "<td align='right'>" . $StatisticsArray[$i+1+$NumQuestions] . "</td>";
               $TableRow4 .= "<td align='right'>" . 
                    round(100*$StatisticsArray[$i+1+$NumQuestions]/$StatisticsArray[0],1) . "%</td>";
          }
          $TableRow1.="<tr>\n";
          $TableRow2.="<tr>\n";
          $TableRow3.="<tr>\n";
          $TableRow4.="<tr>\n";
          echo $TableRow1;
          echo $TableRow2;
          echo $TableRow3;
          echo $TableRow4;
          echo "</table>\n";
     }
     else {
          echo "<p>No one has taken the quiz yet.</p>\n";
     }

?>
</body></html>

