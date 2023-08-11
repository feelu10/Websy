<!DOCTYPE html>
<html>
<head>
  <title>Chinese Zodiac Signs and Colors</title>
  <style>
    /* Add any additional styles you want for the page */
    body {
      font-family: Arial, sans-serif;
    }

    /* Style for individual animal names with their respective colors */
    .animal {
      font-size: 20px;
      font-weight: bold;
      margin: 5px;
    }

    .rat { color: blue; }
    .ox { color: red; }
    .tiger { color: green; }
    .rabbit { color: pink; }
    .dragon { color: gold; }
    .snake { color: silver; }
    .horse { color: yellow; }
    .goat { color: brown; }
    .monkey { color: white; }
    .rooster { color: orange; }
    .dog { color: black; }
    .pig { color: purple; }
  </style>
</head>
<body>
  <p>
    __________________________________________________________________
    <br><br>
    <strong>[<em>Personalities based on your year animal</em>]</strong>
    <br><br>
    <?php
    $zodiacAnimals = array(
      'Rat' => array('color' => 'blue', 'description' => 'quick-witted, resourceful, versatile, kind.'),
      'Ox' => array('color' => 'red', 'description' => 'diligent, dependable, strong, determined.'),
      'Tiger' => array('color' => 'green', 'description' => 'brave, confident, competitive, unpredictable.'),
      'Rabbit' => array('color' => 'pink', 'description' => 'quiet, elegant, kind, responsible.'),
      'Dragon' => array('color' => 'gold', 'description' => 'confident, intelligent, enthusiastic.'),
      'Snake' => array('color' => 'silver', 'description' => 'enigmatic, intelligent, wise.'),
      'Horse' => array('color' => 'yellow', 'description' => 'animated, active, energetic.'),
      'Goat' => array('color' => 'brown', 'description' => 'calm, gentle, sympathetic.'),
      'Monkey' => array('color' => 'white', 'description' => 'sharp, smart, curious.'),
      'Rooster' => array('color' => 'orange', 'description' => 'observant, hardworking, courageous.'),
      'Dog' => array('color' => 'black', 'description' => 'lovely, honest, prudent.'),
      'Pig' => array('color' => 'purple', 'description' => 'compassionate, generous, diligent.')
    );

    foreach ($zodiacAnimals as $animal => $data) {
      $color = $data['color'];
      $description = $data['description'];
      echo "<span class='animal' style='color: $color;'>$animal:</span> $description <br><br>";
    }
    ?>
    __________________________________________________________________
  </p>
</body>
</html>
