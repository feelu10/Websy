<style>
    body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f0f0f0;
    color: #333;
    margin: 0;
    padding: 0;
  }

  td{
    background-image: url('https://img.freepik.com/free-vector/chinese-new-year-animals-vector-gold-animal-zodiac-sign-stickers-set_53876-136014.jpg?w=740&t=st=1690986822~exp=1690987422~hmac=6b48dc1fa30d9ce11acdb7bec70de068aa5abfd5048bc637e78d78011f998d7a');
  }
  
  h2 {
    color: rgb(70, 5, 5);
  }
  
  h3 {
    color: black;
    margin-bottom: 10px;
  }
  
  p {
    margin-bottom: 20px;
  }
  
  a {
    text-decoration: none;
  }
  
  a:hover {
    color: #0056b3;
  }
  
  .container {
    max-width: 600px;
    margin: 2rem auto;
    background-color: #ffffffd7;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }
  
  .center {
    text-align: center;
  }
  
  .button {
    margin-top: 2rem;
    display: inline-block;
    padding: 10px 20px;
    background-color: skyblue;
    color: #fff;
    border-radius: 5px;
    margin-right: 10px;
  }
  
  .button:hover {
    background-color: #0056b3;
    color: black;
  }
  
  p,
  h2,
  h3 {
    text-align: center;
    margin: 1rem 0;
    padding: 0;
  }
  .container{
    width: auto;
    overflow-x: auto;   /* Add horizontal scroll bar if necessary */
    overflow-y: hidden; /* Hide vertical overflow */
    word-wrap: break-word; /* Break words to next line */
    white-space: normal; /* Break lines to fit container */
  }
  .statistics-link {
    display: block;
    text-align: center;
    margin-top: 20px;
  }
  #content2, #content3{
    display: none;
  }
  
</style>
<div class="container">
<!-- Extra credit: update this tab to link to the quiz. -->
<p style = "text-align:center">
</p>
<div id="content1">
  <h2>Midterm Assessment</h2>
  <p style='color:black;'>In this project, students will combine the knowledge learned
  in the first six chapters to create a quiz about the Chinese zodiac.</p>
</div>

<div style = "text-align:center" id="content2">
<a id="quiz"><h3>Chinese&nbsp;Zodiac&nbsp;Quiz</h3></a>	
This all-in-one Web form presents the visitor with a quiz about the Chinese zodiac. 
The PHP script validates the input, grades the quiz, and notifies the visitor of the
results in the browser and an email message.
</div>

<div style = "text-align:center" id="content3">
<a id="quiz"><h3>Chinese&nbsp;Statistics&nbsp;Quiz</h3></a>	
This script shows the visitor summary information about the overall scores of everyone
who has taken the Chinese zodiac quiz.
</div>

<?php
    // Check if the "page" parameter is set in the URL
    if (isset($_GET['page'])) {
        $currentPage = $_GET['page'];

        // Check if the "quiz" parameter is set in the URL
        if (isset($_GET['quiz']) && $_GET['quiz'] === '') {
            // Show the content of quiz.php when both "page" and "quiz" parameters are present
            include 'MidtermAssessment/quiz.php';
        } 
        // Check if the "source" parameter is set in the URL
        elseif (isset($_GET['source'])) {
          // Show the content of source.php when both "page" and "source" parameters are present
          include 'MidtermAssessment/quiz_source.php';
        }
        // Check if the "data" parameter is set in the URL
        elseif (isset($_GET['data'])) {
            // Show the content of quiz_statistics.php when both "page" and "data" parameters are present
            include 'MidtermAssessment/quiz_statistics.php';
        }
        else {
            // Check the value of the "page" parameter to determine which buttons to display
            if ($currentPage === 'midterm_assessment') {
                // Show buttons for the "midterm_assessment" page
                echo '<div style="text-align: center;">';
                echo '<a class="button" href="index.php?page=midterm_assessment&quiz">Test the Script</a>';
                echo '<a class="button" href="index.php?page=midterm_assessment&source=true">View Source Code of Quiz</a>';
                echo '</div>';
            } elseif ($currentPage === 'another_page') {
                // Show buttons for another page if needed
                // Add additional elseif blocks for more pages if required
            } else {
                // Default case: page not recognized, don't show any buttons
            }
        }
    }
?>
