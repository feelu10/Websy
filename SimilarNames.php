<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Similar Names</title>
  <link rel="stylesheet" type="text/css" href="ChineseZodiac.css" />
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
  <h1>Similar Names</h1>
  <hr />

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
    "Pig"
  );

  // Convert all elements to uppercase to ensure consistent casing for comparison
  $SignNames = array_map('strtoupper', $SignNames);

  function calculateLevenshtein($word1, $word2) {
    return levenshtein(strtoupper($word1), strtoupper($word2));
  }

  function calculateSimilarText($word1, $word2) {
    similar_text(strtoupper($word1), strtoupper($word2), $percent);
    return $percent;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedSign1 = isset($_POST["sign1"]) ? $_POST["sign1"] : '';
    $selectedSign2 = isset($_POST["sign2"]) ? $_POST["sign2"] : '';

    $levenshteinValue = calculateLevenshtein($selectedSign1, $selectedSign2);
    $similarTextValue = calculateSimilarText($selectedSign1, $selectedSign2);

    echo "<p>The levenshtein() function has determined that &quot;$selectedSign1&quot;
              and &quot;$selectedSign2&quot; are $levenshteinValue characters apart.</p>\n";
    echo "<p>The similar_text() function has determined that &quot;$selectedSign1&quot;
              and &quot;$selectedSign2&quot; have a similarity of $similarTextValue%.</p>\n";
  }
  ?>

  <form method="post" action="">
    <label for="sign1">Select a sign:</label>
    <select name="sign1" id="sign1">
      <?php
      foreach ($SignNames as $sign) {
        echo "<option value=\"$sign\">$sign</option>";
      }
      ?>
    </select>
    <br>
    <label for="sign2">Select another sign:</label>
    <select name="sign2" id="sign2">
      <?php
      foreach ($SignNames as $sign) {
        echo "<option value=\"$sign\">$sign</option>";
      }
      ?>
    </select>
    <br>
    <input type="submit" value="Check Similarity" />
  </form>

</body>
</html>
