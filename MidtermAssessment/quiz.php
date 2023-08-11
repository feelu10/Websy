<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<title>What do you know about the Chinese zodiac signs?</title>
<style>
#content1, #content3{
    display: none;
}

#content2{
    display: block;
}
</style>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body style="background-image: url('https://img.freepik.com/free-vector/hand-drawn-chinese-zodiac-animals-illustration_23-2149993496.jpg?w=740&t=st=1690987482~exp=1690988082~hmac=e23dc1384854ca7506dda7330ef1f6262070aa7c43b218e556f6b60211f1c5ac');
">
<h2 style="margin-top: 2rem; font-size:40px;font-weight:bolder;">What do you know about the Chinese zodiac signs?</h2>
<div style="text-align: center;">
     <p id="error-message" style="color: red; font-weight: bold; display: none;">Please fill out all fields before submitting the quiz.</p>
</div>
<?php
// Starting value 95: Reading questions from a text file.
function ParseTrueFalseQuestion($InputLine) {
     $retval = FALSE;
     $InputFields = explode('~',$InputLine);
     if (count($InputFields)>=3) {
          $InputFields[1]=htmlentities(trim($InputFields[1]));
          $InputFields[2]=strtoupper(trim($InputFields[2]));
          if ($InputFields[2]=='T' ||
              $InputFields[2]=='TRUE' ||
              $InputFields[2]=='F' ||
              $InputFields[2]=='FALSE') {
               if (strlen($InputFields[1])>0) {
                    $retval=array(
                              'Type'          => 'TF',
                              'Question'      => $InputFields[1],
                              'CorrectAnswer' => substr($InputFields[2],0,1));
               }
          }
     }
     
     return($retval);
}

function ParseMultipleChoiceQuestion($InputLine) {
     $retval = FALSE;
     $InputFields = explode('~',$InputLine);
     if (count($InputFields)>=4) {
          $InputFields[1]=htmlentities(trim($InputFields[1]));
          $InputFields[2]=trim($InputFields[2]);
          $IncorrectAnswers=explode('|',$InputFields[3]);
          $IncorrectAnswerCount=count($IncorrectAnswers);
          $ValidIncorrectAnswerCount=0;
          if ($IncorrectAnswerCount>0) {
               for ($i=0;$i<$IncorrectAnswerCount;++$i) {
                    $IncorrectAnswers[$i]=trim($IncorrectAnswers[$i]);
                    if ((strlen($IncorrectAnswers[$i])>0) &&
                        (strcmp($IncorrectAnswers[$i],$InputFields[2])!=0)) {
                         ++$ValidIncorrectAnswerCount;
                         $IncorrectAnswers[$i]=htmlentities($IncorrectAnswers[$i]);
                    }
               }
               if ((strlen($InputFields[2])>0) &&
                   ($ValidIncorrectAnswerCount>0)) {
                    if (strlen($InputFields[1])>0) {
                         $retval=array(
                         'Type'             => 'MC',
                         'Question'         => $InputFields[1],
                         'CorrectAnswer'    => $InputFields[2],
                         'IncorrectAnswers' => $IncorrectAnswers);
                    }
               }
          }
     }
     
     return($retval);
}

function ParseFillInTheBlankQuestion($InputLine) {
     $retval = FALSE;
     $InputFields = explode('~',$InputLine);
     if (count($InputFields)>=3) {
          $InputFields[1]=htmlentities(trim($InputFields[1]));
          $CorrectAnswers=explode('|',$InputFields[2]);
          $CorrectAnswerCount=count($CorrectAnswers);
          $ValidCorrectAnswerCount=0;
          if ($CorrectAnswerCount>0) {
               for ($i=0;$i<$CorrectAnswerCount;++$i) {
                    $CorrectAnswers[$i]=trim($CorrectAnswers[$i]);
                    if (strlen($CorrectAnswers[$i])>0) {
                         ++$ValidCorrectAnswerCount;
                    }
               }
               if ($ValidCorrectAnswerCount>0) {
                    if (strlen($InputFields[1])>0) {
                         $retval=array(
                    'Type'           => 'FB',
                    'Question'       => $InputFields[1],
                    'CorrectAnswers' => $CorrectAnswers);
                    }
               }
          }
     }
     
     return($retval);
}

function ReadQuestionsIntoArray() {
     $retval = array();
     $InputText=file("MidtermAssessment/quiz_questions.txt");
     foreach ($InputText as $CurrentLine) {
          $CurrentLine=trim($CurrentLine);
          // Make sure line is not blank
          if (strlen($CurrentLine)>0) {
               // Check for comment
               if (substr($CurrentLine,0,1)!='#') {
                    switch (strtoupper(substr($CurrentLine,0,2))) {
                         case "TF":
                            $result=ParseTrueFalseQuestion($CurrentLine);
                            break;
                         case "MC":
                            $result=ParseMultipleChoiceQuestion($CurrentLine);
                            break;
                         case "FB":
                            $result=ParseFillInTheBlankQuestion($CurrentLine);
                            break;
                         default:
                            $result=FALSE;
                            break;
                    }
                    if ($result!==FALSE) 
                         $retval[] = $result;
               }
          }
     }

     return($retval);
};

function ValidateResponseIntoArrray($Question,$Response) {
     $retval=FALSE;
     switch ($Question['Type']) {
          case 'TF':
               $retval=array(
               'Right' => (strncasecmp($Question['CorrectAnswer'],$Response,1)==0),
               'CorrectAnswer' => (strncasecmp($Question['CorrectAnswer'],'T',1)==0?
                    'True' : 'False'),
               'Response' => (strncasecmp($Response,'T',1)==0?
                    'True' : 'False'));
               break;
          case 'MC':
               $retval=array(
                    'Right' => (strcasecmp($Question['CorrectAnswer'],$Response)==0),
                    'CorrectAnswer' => $Question['CorrectAnswer'],
                    'Response' => $Response);
               break;
          case 'FB':
               $Correct=FALSE;
               $pattern="/\b" . $Response . "\b/i";
               // Show the first correct answer by default.
               $DisplayAnswer=$Question['CorrectAnswers'][0];
               foreach ($Question['CorrectAnswers'] as $CorrectAnswer) {
                    if (preg_match($pattern,$CorrectAnswer)>0) {
                         $Correct=TRUE;
                         // Show the correct answer that matched the response.
                         $DisplayAnswer=$CorrectAnswer;
                    }
               }
               $retval=array(
                    'Right' => $Correct,
                    'CorrectAnswer' => $DisplayAnswer,
                    'Response' => $Response);
               break;
     }
     return($retval);
}

$Questions=ReadQuestionsIntoArray();
$NumQuestions=count($Questions);
$ShowForm=TRUE;
$Errors="";
$BlankResponseCount=0;
$Responses=array();
$ResponseValidity=array();
$ResponseErrors=array();

// Extra credit: randomize the display order.
$DisplayOrder=array();
$MCDisplayOrder=array();
$VisitorName="";
$VisitorEmail="";

$Results=array();
$CorrectAnswerCount=0;
$MsgBody="";

// Starting value 95: An all-in-one form
if (isset($_POST['submit'])) {
     $ShowForm=FALSE;
     
     // Read the display order stored in hidden fields in the form
     $DisplayOrder=$_POST['DisplayOrder'];
     
     // Read any multiple-choice display orders stored in hidden fields in the form
     $MCDisplayOrder=$_POST['MCDisplayOrder'];
     
     // Validate email address
     if (isset($_POST['VisitorName'])) {
          $VisitorName=trim(stripslashes($_POST['VisitorName']));
     }
     if (strlen($VisitorName)==0) {
          $Errors .= "You did not enter your name.<br />\n";
          $ShowForm=TRUE;
     }
     
     // Validate email address
     if (isset($_POST['VisitorEmail'])) {
          $VisitorEmail=trim(stripslashes($_POST['VisitorEmail']));
     }
     if (strlen($VisitorEmail)==0) {
          $Errors .= "You did not enter your email address.<br />\n";
          $ShowForm=TRUE;
     }
     // Starting value 90: validate the email address format
     else {
          $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i";
          if (preg_match($pattern, $VisitorEmail)==0) {
               $Errors .= "The email address entered is not valid.<br />\n";
               $ShowForm=TRUE;
          }
     }
     
     for ($i=0;$i<$NumQuestions;++$i) {
          $index=$DisplayOrder[$i];
          // Starting value 90: the responses are posted in an array
          if ((isset($_POST['response'][$index])) &&
              (strlen($_POST['response'][$index])>0)) { // Process response
               $Responses[$index]=trim(stripslashes($_POST['response'][$index]));
          }
          else { // A missing response is an error
               $Errors .= "You did not answer Question " . ($i+1) . ".<br />\n";
               ++$BlankResponseCount;
               $ShowForm=TRUE;
          }
     }
     if ($BlankResponseCount>0) { // A missing response is an error
          $Errors .= "You left " . $BlankResponseCount . " questions blank. ".
               "All " . $NumQuestions . "questions must be answered before the quiz is graded.<br />\n";
          $ShowForm=TRUE;
     }
} 
else {
     // This is the first visit, create a random display order for the questions.
     for ($i=0;$i<$NumQuestions;++$i) {
          $DisplayOrder[$i]=$i;
          if (strcasecmp($Questions[$i]['Type'],'MC')==0) {
               $MCDisplayOrder[$i]=array();
               // The first elements in the array are positions of the incorrect answers,
               // The last element in the array is the position of the correct answer.
               for ($j=0;$j<=count($Questions[$i]['IncorrectAnswers']);++$j) {
                    $MCDisplayOrder[$i][$j]=$j;
               }
               shuffle($MCDisplayOrder[$i]);
          }
     }
     shuffle($DisplayOrder);
}
// Clear out validation array if all questions were not answered or errors were found.
if ((count($ResponseValidity)<$NumQuestions) ||
     (strlen($Errors)>0)) {
     $ResponseValidity=array();
}

if (strlen($Errors)>0) {
     echo "<p id='p'>The following errors were found:</p>\n";
     echo "<p id='p'>" . $Errors . "</p>\n";
}
else if (isset($_POST['submit'])) {
     // Once the form is successfully filled out, grade it.
     for ($i=0;$i<$NumQuestions;++$i) {
          $index=$DisplayOrder[$i];
          $CurrentResult=ValidateResponseIntoArrray($Questions[$index],$Responses[$index]);
          $Results[]=$CurrentResult;
          if ($CurrentResult['Right']) {
               ++$CorrectAnswerCount;
               $MsgBody .= "Question " . ($i+1) . ") " . $CurrentResult['Response'] . 
                    " - Correct.\n";
               echo "<p id='p'>" . ($i+1) . ") " . $Questions[$index]['Question'] . "<br />\n";
               echo " &nbsp; &nbsp; <font color='green'>&#10004;</font> Your answer, &ldquo;" . htmlentities($CurrentResult['Response']) .
                    "&rdquo; is correct.</p>\n";
          }
          else {
               $MsgBody .= "Question " . ($i+1) . ") " . $CurrentResult['Response'] . 
                    " - Incorrect (" . $CurrentResult['CorrectAnswer'] . 
                    ").\n";
               echo "<p id='p'>" . ($i+1) . ") " . $Questions[$index]['Question'] . "<br />\n";
               echo " &nbsp; &nbsp; <font color='red'>&#10008;</font> Your answer, &ldquo;" . htmlentities($CurrentResult['Response']) .
                    "&rdquo; is incorrect. The correct answer is &ldquo;" . htmlentities($CurrentResult['CorrectAnswer']) .
                    "&rdquo;.</p>\n";
          }
     }
     $ScoreText="You answered $CorrectAnswerCount out of the $NumQuestions questions correctly, " .
          " for a score of " . round(100*$CorrectAnswerCount/$NumQuestions) . "%.";
          
     // Extra credit: custom messages based on the score.
     $ScoreMessage="";
     switch ($CorrectAnswerCount) {
          case 10:
               $ScoreMessage="You are a Chinese zodiac Expert!";
               break;
          case 9:
          case 8:
               $ScoreMessage="You really know your Chinese zodiac signs!";
               break;
          case 7:
          case 6:
               $ScoreMessage="You've done some research on the Chinese zodiac.";
               break;
          case 5:
          case 4:
          case 3:
               $ScoreMessage="You know some things about the Chinese zodiac.";
               break;
          case 2:
          case 1:
               $ScoreMessage="You really need to study the Chinese zodiac.";
               break;
          case 0:
               $ScoreMessage="You missed every question!";
               break;
     }
     $MsgBody .= $ScoreText . "\n" . $ScoreMessage . "\n";
     
     echo "<h3>$ScoreText<br />\n";
     echo "$ScoreMessage</h3>\n";
     
     
     // Starting value 100: Store statistics about the quiz
     $StatisticsFile="statistics/quiz_statistics.txt";
     $StatisticsArray=array();
     if (file_exists($StatisticsFile)) {
          // Could also use $StatisticsData=file_get_contents($StatisticsFile,$StatisticsData);
          $fh=fopen($StatisticsFile,"rb");
          if ($fh!==FALSE) {
               $StatisticsData=fread($fh,4096);
               fclose($fh);
          }
          $StatisticsArray=explode("\n",$StatisticsData);
          $len=count($StatisticsArray);
     }
     else {
          // If the file does not exist, initialize the array.
          $StatisticsArray[]=0; // Initialize the total number of people to take the quiz
          for ($i=0;$i<$NumQuestions;++$i) // Initialize each question's count
               $StatisticsArray[]=0;
          for ($i=0;$i<=$NumQuestions;++$i) // Initialize each score's count
               $StatisticsArray[]=0;
     }
     // Update the total number of people to take the quiz
     ++$StatisticsArray[0];
     // Update toe totals for each question
     for ($i=0;$i<$NumQuestions;++$i) {
          $index=$DisplayOrder[$i];
          // If the question is answered correctly, update the count
          if ($Results[$i]['Right'])
               ++$StatisticsArray[$index+1]; // Skip the element that has the total
     }
     // Update the count for the score 
     ++$StatisticsArray[$CorrectAnswerCount+1+$NumQuestions]; // Skip the element that has the total, plus the question elements
     // Save the result back to the file.
     $StatisticsData=implode("\n",$StatisticsArray);
   
}

if ($ShowForm) {
// Starting value 100: The form is a sticky form.
?>
<form action="index.php?page=midterm_assessment&quiz" method="post" style="background-color: #636161f1; padding:1.5rem">
<p style="display:inline-flex; margin: 0 auto;">
<input type="text" id name="VisitorName" style="height: 5px; margin-right:8px;" placeholder="Username" value="<?php echo $VisitorName; ?>" required /><br />
<input type="text" name="VisitorEmail" style="height: 5px;" placeholder="Email" value="<?php echo $VisitorEmail; ?>" required/><br />
<br />&nbsp;<br /></p>
<?php
     echo "<p id='p'>You must answer all " . $NumQuestions . 
          " questions before the quiz will be graded.</p>\n";
     // Save the current display orders in the form so the questions 
     // and answers will always be presented in the same order.
     for ($i=0;$i<$NumQuestions;++$i) {
          echo "<input required type='hidden' name='DisplayOrder[$i]' value='" . 
               $DisplayOrder[$i] . "' />\n";
          if (strcasecmp($Questions[$i]['Type'],'MC')==0) {
               // The first elements in the array are positions of the incorrect answers,
               // The last element in the array is the position of the correct answer.
               for ($j=0;$j<=count($Questions[$i]['IncorrectAnswers']);++$j) {
                    echo "<input required type='hidden' name='MCDisplayOrder[$i][$j]' value='" . 
                         $MCDisplayOrder[$i][$j] . "' />\n";
               }
          }
     }
     for ($i=0;$i<$NumQuestions;++$i) {
          $index=$DisplayOrder[$i];
          echo "<p id='p'>" . ($i+1) . ") " . $Questions[$index]['Question'] . "</p>\n";
          switch ($Questions[$index]['Type']) {
               case "TF": // true/false
                    echo "<p id='p'> &nbsp; &nbsp; True ";
                    echo "<input required type='radio' name='response[$index]' value='T'";
                    if ((isset($Responses[$index])) && 
                         ($Responses[$index]=='T')) {
                         echo " checked='checked'";
                    }
                    echo " /> &nbsp; &nbsp; False ";
                    echo "<input required type='radio' name='response[$index]' value='F'";
                    if ((isset($Responses[$index])) && 
                         ($Responses[$index]=='F')) {
                         echo " checked='checked'";
                    }
                    echo " /></p>\n";
                    break;

                    case "MC": // multiple choice
                    echo "<p id='p'> &nbsp; &nbsp;\n";
                    echo "<input required type='text' name='response[$index]' placeholder='Enter your answer' value='";
                    if (isset($Responses[$index])) {
                         echo htmlentities($Responses[$index]);
                    }
                    echo "' /></p>\n";
                    // Display the user's response
                    if (isset($Responses[$index])) {
                         echo "<p id='p'>Your Response: " . htmlentities($Responses[$index]) . "</p>";
                    }
                    break;

               default: // assume "FB" for fill in the blank
                    echo "<p id='p'> &nbsp; &nbsp; Enter your response here: ";
                    echo "<input required type='text' name='response[$index]' value='";
                    if (isset($Responses[$index])) {
                         echo htmlentities($Responses[$index]);
                    }
                    echo "' /></p>\n";
                    break;
               }
          }
?>
<p id="btns">
<input type="reset" name="reset" value="Clear Quiz" />
<input type="submit" name="submit" value="Grade Quiz" />
</p>
</form>
<?php
}   // Insert quiz results into the database
if (!$ShowForm && isset($_POST['submit'])) {
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "websy";
 
     $conn = new mysqli($servername, $username, $password, $dbname);
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
 
     // Prepare the SQL statement
     $stmt = $conn->prepare("INSERT INTO quiz_results (user_name, user_email, score) VALUES (?, ?, ?)");
     $stmt->bind_param("ssi", $VisitorName, $VisitorEmail, $CorrectAnswerCount);
 
     // Execute the prepared statement
     $stmt->execute();
 
     // Close the statement and database connection
     $stmt->close();
     $conn->close();
 
     // Send quiz results to the user via email only if not in a local environment
     if ($_SERVER['HTTP_HOST'] !== 'localhost') {
         $subject = "Chinese Zodiac Quiz Results";
         $headers = "From: Your Quiz Team <noreply@example.com>\r\n";
         $headers .= "Reply-To: Your Quiz Team <contact@example.com>\r\n";
         $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
 
         // Send the email
         if (mail($VisitorEmail, $subject, $MsgBody, $headers)) {
             echo "<h3>A message was sent to your email address with your results.</h3>";
         } else {
             echo "<h3>There was a problem sending the results to your email address.</h3>";
         }
     }
 }
 

?>
<style>
     h1 {
            text-align: center;
            color: white;
            font-size: 30px;
            padding-top: 30px;
        }
     em{
          display: none;
     }

        form {
            background-color: #636161f1;
            padding: 1.5rem;
            max-width: 600px;
            margin: 0 auto;
        }

        #p {
            color: violet;
            text-align: start;
        }
        p {
            color: white;
            text-align: center;
        }

        input[type="text"],
        select {
            height: 30px;
            margin-right: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 18px;
            color: black;
        }

        .btns {
            text-align: center;
            margin-top: 20px;
        }

        input[type="reset"],
        input[type="submit"] {
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 20px;
            cursor: pointer;
        }

        .links {
            text-align: center;
            margin-top: 20px;
        }

        .links a {
            color: #007bff;
            text-decoration: none;
        }

        .links a i {
            margin-right: 5px;
        }
        #btns{
          text-align: center;
          margin-top: 2rem;
        }
        
</style>
<!-- Extra credit: provide a link to the statistics page. -->
<h6 id="links" style="text-align:center;">
Back to <a href='index.php?page=midterm_assessment&data'><i class="fas fa-arrow-left"></i>Midterm Assessment</a> to view source code.
</h6>
<h6 id="links" style="text-align:center;">
     Visit the <a href='index.php?page=midterm_assessment&data'><i class="fas fa-arrow-right"></i>Quiz Statistics</a> page to see how others have done.
</h6>
</body>
</html>

