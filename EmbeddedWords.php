<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Embedded Words</title>
  <link rel="stylesheet" type="text/css" href="ChineseZodiac.css" />
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
  <h1>Embedded Words</h1>
  <hr />

  <form method="post" action="">
    <label for="phrase">Enter a phrase:</label>
    <input type="text" name="phrase" id="phrase" />
    <input type="submit" value="Check" />
  </form>

  <?php
  // Check if the form is submitted and process the input
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputPhrase = isset($_POST["phrase"]) ? $_POST["phrase"] : '';

    $Phrases = array(
      "Your Chinese Zodiac signs tell a lot about your personality.",
      "Embed PHP scripts within an XHTML document."
    );

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
      "Pig"
    );

    function BuildLetterCounts($text) {
      $text = strtoupper($text);
      $letter_counts = count_chars($text);
      return $letter_counts;
    }

    function AContainsB($A, $B) {
      $retval = TRUE;
      $first_letter_index = ord('A');
      $last_letter_index = ord('Z');
      for ($letter_index = $first_letter_index; $letter_index <= $last_letter_index; ++$letter_index) {
        if (strcmp($A[$letter_index], $B[$letter_index]) < 0) {
          $retval = FALSE;
          break;
        }
      }
      return $retval;
    }

    echo "<h2>Results for phrase: $inputPhrase</h2>";

    $inputPhraseArray = BuildLetterCounts($inputPhrase);
    $GoodWords = array();
    $BadWords = array();

    foreach ($SignNames as $Sign) {
      $SignArray = BuildLetterCounts($Sign);
      if (AContainsB($inputPhraseArray, $SignArray)) {
        $GoodWords[] = $Sign;
      } else {
        $BadWords[] = $Sign;
      }
    }

    echo "<p><strong>Good words:</strong> " . implode(', ', $GoodWords) . "</p>";
    echo "<p><strong>Bad words:</strong> " . implode(', ', $BadWords) . "</p>";
    echo "<hr />";
  }
  ?>
</body>
</html>
