<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        #content1{
            display: none;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">View Quiz Source Code</h2>
<div class="container">
<?php
    // Always show the source code for "quiz.php"
    $sourceFile = 'MidtermAssessment/quiz.php';

    if(file_exists($sourceFile)) {
        // Use the highlight_file function to display the source code
        highlight_file($sourceFile);
    } else {
        echo "File does not exist.";
    }
?>
</div>
</body>
</html>
